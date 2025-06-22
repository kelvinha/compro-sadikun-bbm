<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\PageHelper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get blog page from CMS
        $blogPage = PageHelper::getBlogPage();
        // If blog page doesn't exist, create a fallback
        if (!$blogPage) {
            $blogPage = PageHelper::createFallbackPage(
                'Our Blog',
                'Stay updated with the latest news, insights, and articles from our team.',
                'blog, news, articles, insights, updates'
            );
        }


        // Get category filter
        $categoryId = $request->input('category');
        $category = null;

        if ($categoryId) {
            $category = BlogCategory::find($categoryId);
        }

        // Get published blogs
        $query = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc');

        // Apply category filter
        if ($category) {
            $query->where('category_id', $category->id);
        }

        $blogs = $query->paginate(9);
        $currentBlogs = $query->paginate(5);

        // Get featured blogs for sidebar
        $featuredBlogs = Blog::where('status', 'published')
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get categories with post count
        $categories = BlogCategory::withCount(['blogs' => function($query) {
            $query->where('status', 'published');
        }])->having('blogs_count', '>', 0)->get();

        return view('landing.blog', compact('blogPage', 'blogs', 'featuredBlogs', 'categories', 'category','currentBlogs'));
    }

    /**
     * Display the specified blog post.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Find the blog post by slug
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Load SEO settings for the blog post
        $blog->load('seo');

        // Get related blogs
        $relatedBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->where(function ($query) use ($blog) {
                if ($blog->category_id) {
                    $query->where('category_id', $blog->category_id);
                }
            })
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get blog page from CMS for breadcrumb
        $blogPage = PageHelper::getBlogPage();

        // If blog page doesn't exist, create a fallback
        if (!$blogPage) {
            $blogPage = PageHelper::createFallbackPage('Our Blog');
        }

        // Get published blogs
        $query = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc');
        $currentBlogs = $query->paginate(5);

        $categories = BlogCategory::withCount(['blogs' => function($query) {
            $query->where('status', 'published');
        }])->having('blogs_count', '>', 0)->get();

        return view('landing.blog-detail', compact('blog', 'relatedBlogs', 'blogPage','categories','currentBlogs'));
    }

    /**
     * Display blogs by category.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function category($slug)
    {
        // Find the category by slug
        $category = BlogCategory::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        // Get blog page from CMS
        $blogPage = PageHelper::getBlogPage();

        // If blog page doesn't exist, create a fallback
        if (!$blogPage) {
            $blogPage = PageHelper::createFallbackPage(
                'Our Blog',
                'Stay updated with the latest news, insights, and articles from our team.',
                'blog, news, articles, insights, updates'
            );
        }

        // Load SEO settings for the blog page
        if ($blogPage->seo) {
            $blogPage->load('seo');
        }

        // Get published blogs in this category
        $blogs = Blog::where('status', 'published')
            ->where('category_id', $category->id)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        // Get featured blogs for sidebar
        $featuredBlogs = Blog::where('status', 'published')
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get categories with post count
        $categories = BlogCategory::withCount(['blogs' => function($query) {
            $query->where('status', 'published');
        }])->having('blogs_count', '>', 0)->get();

        return view('landing.blog', compact('blogPage', 'blogs', 'featuredBlogs', 'categories', 'category'));
    }
}
