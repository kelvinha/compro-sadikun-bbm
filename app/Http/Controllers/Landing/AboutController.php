<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\PageHelper;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Blog;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get about page from CMS
        $aboutPage = PageHelper::getAboutPage();

        // If about page doesn't exist, create a fallback
        if (!$aboutPage) {
            $aboutPage = PageHelper::createFallbackPage(
                'About Us',
                'Learn more about PT Industri Teknologi Torsi and our commitment to excellence.',
                'about us, company, history, mission, vision, values, team'
            );
        }

        // Load SEO settings for the about page
        if ($aboutPage->seo) {
            $aboutPage->load('seo');
        }

        // Get testimonials
        $testimonials = Testimonial::where('status', '1')
            ->orderBy('order', 'asc')
            ->take(10)
            ->get();

        // Get current blog
        $currentBlogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')->paginate(3);

        return view('landing.about', compact('aboutPage', 'testimonials','currentBlogs'));
    }
}
