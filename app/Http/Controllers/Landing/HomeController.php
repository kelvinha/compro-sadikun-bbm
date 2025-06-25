<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\MenuHelper;
use App\Helpers\PageHelper;
use App\Helpers\ProductHelper;
use App\Helpers\ProjectHelper;
use App\Helpers\SettingsHelper;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Client;
use App\Models\Product;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Submenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get featured blogs
        $featuredBlogs = Blog::where('status', 'published')
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get featured projects
        $featuredProjects = ProjectHelper::getFeatured(3);

        // Get featured products
        $featuredProducts = ProductHelper::getFeatured(3);

        // Get testimonials client
        $testimonials = Testimonial::where('status', '1')
            ->orderBy('order', 'asc')
            ->take(10)
            ->get();

        // Get Banners
        $banners = Banner::where('active', '1')
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        // Get Clients
        $clients = Client::where('active', '1')
            ->orderBy('order', 'asc')
            ->get();

        return view('landing.index', compact('featuredBlogs', 'featuredProjects', 'featuredProducts','testimonials','banners','clients'));
    }

    /**
     * Display a page.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function page($slug)
    {
        // Find the page by slug
        $page = PageHelper::getBySubmenuSlug($slug);

        if (!$page) {
            abort(404);
        }

        // Get page sections
        $sections = $page->sections;

        return view('landing.page', compact('page', 'sections'));
    }




}
