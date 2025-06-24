<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('order')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::where('status', 'active')->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_catalog' => 'nullable|file|mimes:pdf|max:10240', // 10MB max for PDF
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:product_categories,id',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPath = $file->store('products/gallery', 'public');
                $gallery[] = $galleryPath;
            }
            $validated['gallery'] = $gallery;
        }

        if ($request->hasFile('product_catalog')) {
            $catalogPath = $request->file('product_catalog')->store('product-catalogs', 'public');
            $validated['product_catalog'] = $catalogPath;
        }

        $product = Product::create($validated);

        // Create SEO settings
        $product->seo()->create([
            'title' => $validated['meta_title'] ?? $validated['title'],
            'description' => $validated['meta_description'] ?? substr(strip_tags($validated['short_description'] ?? ''), 0, 160),
            'keywords' => $validated['meta_keywords'] ?? '',
            'og_title' => $validated['meta_title'] ?? $validated['title'],
            'og_description' => $validated['meta_description'] ?? substr(strip_tags($validated['short_description'] ?? ''), 0, 160),
            'og_image' => $validated['image'] ?? null
        ]);

        Alert::success('Success', 'Product created successfully.');
        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('status', 'active')->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_catalog' => 'nullable|file|mimes:pdf|max:10240', // 10MB max for PDF
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:product_categories,id',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('gallery')) {
            $gallery = $product->gallery ?? [];

            foreach ($request->file('gallery') as $file) {
                $galleryPath = $file->store('products/gallery', 'public');
                $gallery[] = $galleryPath;
            }

            $validated['gallery'] = $gallery;
        }

        if ($request->hasFile('product_catalog')) {
            // Delete old catalog if exists
            if ($product->product_catalog) {
                Storage::disk('public')->delete($product->product_catalog);
            }

            $catalogPath = $request->file('product_catalog')->store('product-catalogs', 'public');
            $validated['product_catalog'] = $catalogPath;
        }

        // Handle gallery deletions
        if ($request->has('delete_gallery')) {
            $gallery = $product->gallery ?? [];
            $toDelete = $request->input('delete_gallery');

            foreach ($toDelete as $path) {
                Storage::disk('public')->delete($path);
                $gallery = array_filter($gallery, function($item) use ($path) {
                    return $item !== $path;
                });
            }

            $validated['gallery'] = array_values($gallery);
        }

        $product->update($validated);

        // Update SEO settings
        $product->seo()->updateOrCreate(
            ['seoable_id' => $product->id, 'seoable_type' => get_class($product)],
            [
                'title' => $validated['meta_title'] ?? $validated['title'],
                'description' => $validated['meta_description'] ?? substr(strip_tags($validated['short_description'] ?? ''), 0, 160),
                'keywords' => $validated['meta_keywords'] ?? '',
                'og_title' => $validated['meta_title'] ?? $validated['title'],
                'og_description' => $validated['meta_description'] ?? substr(strip_tags($validated['short_description'] ?? ''), 0, 160),
                'og_image' => $validated['image'] ?? $product->image
            ]
        );

        Alert::success('Success', 'Product updated successfully.');
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete gallery images if exists
        if (!empty($product->gallery)) {
            foreach ($product->gallery as $galleryImage) {
                Storage::disk('public')->delete($galleryImage);
            }
        }

        // Delete catalog file if exists
        if ($product->product_catalog) {
            Storage::disk('public')->delete($product->product_catalog);
        }

        // Delete SEO settings
        if ($product->seo) {
            $product->seo->delete();
        }

        $product->delete();

        Alert::success('Success', 'Product deleted successfully.');
        return redirect()->route('admin.products.index');
    }
}
