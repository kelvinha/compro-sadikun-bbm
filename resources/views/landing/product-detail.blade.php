@extends('landing.layout.master')

@section('title', $product->seo->title ?? $product->meta_title ?? $product->title)
@section('meta_description', $product->seo->description ?? $product->meta_description ??
Str::limit(strip_tags($product->description), 160))
@section('meta_keywords', $product->seo->keywords ?? $product->meta_keywords ?? 'product, ' . $product->title)

@section('og_title', $product->seo->og_title ?? $product->meta_title ?? $product->title)
@section('og_description', $product->seo->og_description ?? $product->meta_description ??
Str::limit(strip_tags($product->description), 160))
@section('og_image', asset('storage/' . ($product->seo->og_image ?? $product->image ?? '')))

@section('classBody', 'services_listing_page')
@section('content')
    @php
        // Load home page content directly in the view
        $homePage = \App\Helpers\PageHelper::getHomePage();

        // If home page doesn't exist, create a fallback
        if (!$homePage) {
        $homePage = \App\Helpers\PageHelper::createFallbackPage(
        'Home',
        'Welcome to our website. Discover our products and services.',
        'home, welcome, products, services'
        );
        }
    @endphp
    <main class="site-main">
        <!-- START OF MAIN BANNER -->
        <section class="inner-banner back-img" style="background-image: url('{{asset('vendor/landing')}}/assets/images/banner-our-product.png');">
            <div class="banner-stripes">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="banner-shape-wp wow fadeInRight for-des" data-wow-duration=".8s">
                <div class="banner-shape">
                    <span class="stripe"></span>
                    <span class="stripe stripe-secondary"></span>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-banner-content-wp white-text text-center">
                            <div class="inner-banner-content wow fadeInUp" data-wow-duration=".8s">
                                <h2 class="h1-title">Product Detail</h2>
                            </div>
                            <div class="inner-banner-breadcrumb wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <ul>
                                    <li>
                                        <a href="{{ route('home.index')  }}" title="Home">Home</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" title="Portfolio">Products</a>
                                    </li>
                                    <li>
                                        <span>Products Detail</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF MAIN BANNER -->
        <section class="portfolio-content-wp wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portfolio-content">
                            <div class="portfolio-head">
                                <h1 class="h2-title m-0">{{ $product->title }}</h1>
                            </div>
                            {!! $product->description !!}
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('home.products.file', "$product->slug")  }}" target="_blank" class="sec-btn"
                           title="get detail our product">Get detail our products</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
