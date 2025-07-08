<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\PageHelper;
use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get products page from CMS
        $productsPage = PageHelper::getProductsPage();
        // If products page doesn't exist, create a fallback
        if (!$productsPage) {
            $productsPage = PageHelper::createFallbackPage(
                'Our Products',
                'Explore our range of high-quality products.',
                'products, valve automation, control systems, high quality products'
            );
        }

        // Get active product categories
        $categories = ProductHelper::getAllCategories();

        // Get category filter
        $categoryId = $request->input('category');
        $category = null;

        if ($categoryId) {
            $category = ProductCategory::find($categoryId);
        }

        // Get sorting
        $sort = $request->input('sort', 'default');

        // Get active products
        $query = Product::where('status', 'active');

        // Apply category filter
        if ($category) {
            $query->where('category_id', $category->id);
        }

        // Apply sorting
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('order')->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(9);

        // Get featured products
        $featuredProducts = ProductHelper::getFeatured(3);
        return view('landing.product', compact('productsPage', 'products', 'featuredProducts', 'categories', 'category', 'sort'));
    }

    /**
     * Display the specified product.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Find the product by slug
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Load SEO settings for the product
        $product->load('seo');


        // Get related products
        $relatedProducts = ProductHelper::getRelated($product, 4);

        // Get products page from CMS for breadcrumb
        $productsPage = PageHelper::getProductsPage();

        // If products page doesn't exist, create a fallback
        if (!$productsPage) {
            $productsPage = PageHelper::createFallbackPage('Our Products');
        }

        // Get product category
        $category = null;
        if ($product->category_id) {
            $category = ProductCategory::find($product->category_id);
        }

        return view('landing.product-detail', compact('product', 'relatedProducts', 'productsPage', 'category'));
    }

    /**
     * Display products by category.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function category($slug)
    {
        // Find the category by slug
        $category = ProductCategory::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Get products page from CMS
        $productsPage = PageHelper::getProductsPage();

        // If products page doesn't exist, create a fallback
        if (!$productsPage) {
            $productsPage = PageHelper::createFallbackPage(
                'Our Products',
                'Explore our range of high-quality products.',
                'products, valve automation, control systems, high quality products'
            );
        }

        // Get active product categories
        $categories = ProductHelper::getAllCategories();

        // Get products in this category
        $products = Product::where('status', 'active')
            ->where('category_id', $category->id)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Get featured products in this category
        $featuredProducts = Product::where('status', 'active')
            ->where('category_id', $category->id)
            ->where('featured', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $sort = 'default';

        return view('landing.product', compact('productsPage', 'products', 'featuredProducts', 'categories', 'category', 'sort'));
    }

    public function file($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return response()->file(public_path('storage/' . $product->product_catalog), ['Content-Type' => 'application/pdf']);
    }
}
