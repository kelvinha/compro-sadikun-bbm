<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        // Load settings directly in the head
        $settings = \App\Helpers\SettingsHelper::getPublic();

        // Extract common settings
        $websiteName = 'Company Website';
        $metaDescription = 'Company website description';
        $metaKeywords = 'company, website, business';
        $ogImage = null;
        $websiteLogo = null;

        foreach($settings as $setting) {
        if($setting->key === 'website_name') {
        $websiteName = $setting->value;
        } elseif($setting->key === 'meta_description') {
        $metaDescription = $setting->value;
        } elseif($setting->key === 'meta_keywords') {
        $metaKeywords = $setting->value;
        } elseif($setting->key === 'og_image') {
        $ogImage = $setting->value;
        } elseif($setting->key === 'website_logo') {
        $websiteLogo = $setting->value;
        }
        }

        // Determine current page based on the URL
        $currentUrl = request()->path();
        $currentUrl = $currentUrl === '/' ? '/' : '/' . $currentUrl;

        // Load page content based on URL
        $activePage = null;

        // Check for home page
        if ($currentUrl === '/') {
        $activePage = \App\Helpers\PageHelper::getHomePage();
        }
        // Check for about page
        elseif ($currentUrl === '/about') {
        $activePage = \App\Helpers\PageHelper::getAboutPage();
        }
        // Check for blog post
        elseif (strpos($currentUrl, '/blog/') === 0) {
        $slug = substr($currentUrl, 6); // Remove '/blog/' prefix
        $activePage = \App\Models\Blog::where('slug', $slug)
        ->where('status', 'published')
        ->first();

        if ($activePage) {
        $activePage->load('seo');
        }
        }
        // Check for other pages
        else {
        // Try to find by URL first
        $activePage = \App\Helpers\PageHelper::getByUrl($currentUrl);

        // If not found, check if it's a submenu page
        if (!$activePage && strpos($currentUrl, '/page/') === 0) {
        $slug = substr($currentUrl, 6); // Remove '/page/' prefix
        $activePage = \App\Helpers\PageHelper::getBySubmenuSlug($slug);
        }
        }

        // Set default SEO values
        $pageTitle = $websiteName;
        $pageDescription = $metaDescription;
        $pageKeywords = $metaKeywords;
        $pageOgTitle = $websiteName;
        $pageOgDescription = $metaDescription;
        $pageOgImage = $ogImage ?: $websiteLogo;

        // If we have an active page with SEO settings, use them
        if ($activePage && isset($activePage->seo)) {
        $pageTitle = $activePage->seo->title;
        $pageDescription = $activePage->seo->description ?: $metaDescription;
        $pageKeywords = $activePage->seo->keywords ?: $metaKeywords;
        $pageOgTitle = $activePage->seo->og_title ?: $activePage->seo->title;
        $pageOgDescription = $activePage->seo->og_description ?: $activePage->seo->description;
        $pageOgImage = $activePage->seo->og_image ?: ($ogImage ?: $websiteLogo);
        }
    @endphp

            <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', $pageDescription)">
    <meta name="keywords" content="@yield('meta_keywords', $pageKeywords)">
    <title>@yield('title', $pageTitle) - {{ $websiteName }}</title>

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', $pageOgTitle)">
    <meta property="og:description" content="@yield('og_description', $pageOgDescription)">
    @if(View::hasSection('og_image'))
        <meta property="og:image" content="@yield('og_image')">
    @elseif($pageOgImage)
        <meta property="og:image" content="{{ asset('storage/' . $pageOgImage) }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Custom CSS if defined in settings -->
    @php
        $customCss = null;
        foreach($settings as $setting) {
        if($setting->key === 'custom_css') {
        $customCss = $setting->value;
        break;
        }
        }
    @endphp

            <!-- Custom colors -->
    @php
        $primaryColor = null;
        $secondaryColor = null;

        foreach($settings as $setting) {
        if($setting->key === 'primary_color') {
        $primaryColor = $setting->value;
        } elseif($setting->key === 'secondary_color') {
        $secondaryColor = $setting->value;
        }
        }
    @endphp

            <!-- Favicons -->
    @php
        $websiteFavicon = null;
        $websiteFaviconApple = null;
        $websiteFavicon32 = null;
        $websiteFavicon16 = null;
        $websiteManifest = null;

        foreach($settings as $setting) {
            if($setting->key === 'website_favicon') {
                $websiteFavicon = $setting->value;
                } elseif($setting->key === 'website_favicon_apple') {
                $websiteFaviconApple = $setting->value;
                } elseif($setting->key === 'website_favicon_32') {
                $websiteFavicon32 = $setting->value;
                } elseif($setting->key === 'website_favicon_16') {
                $websiteFavicon16 = $setting->value;
                } elseif($setting->key === 'website_manifest') {
                $websiteManifest = $setting->value;
            }
        }
    @endphp

    @if($websiteFavicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $websiteFavicon) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $websiteFavicon) }}">
    @elseif($websiteFaviconApple)
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $websiteFaviconApple) }}">
        <link rel="icon" type="image/png" href="{{ asset('vendor/landing/assets/img/favicon.png') }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('vendor/landing/assets/img/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('vendor/landing/assets/img/favicon.png') }}">
        <!-- FavIcon Link -->
        <link rel="icon" href="{{asset('vendor/landing')}}/assets/images/favicon.png" sizes="32x32" type="image/png">
    @endif

    @if($websiteFavicon32)
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $websiteFavicon32) }}">
    @endif

    @if($websiteFavicon16)
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $websiteFavicon16) }}">
    @endif

    @if($websiteManifest)
        <link rel="manifest" href="{{ asset('storage/' . $websiteManifest) }}">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="{{asset('vendor/landing')}}/assets/css/bootstrap.min.css">
    <!-- Swiper Slider CSS Link -->
    <link rel="stylesheet" href="{{asset('vendor/landing')}}/assets/css/swiper-bundle.min.css">
    <!-- Magnific Popup CSS Link -->
    <link rel="stylesheet" href="{{asset('vendor/landing')}}/assets/css/magnific-popup.min.css">
    <!-- Animate CSS Link -->
    <link rel="stylesheet" href="{{asset('vendor/landing')}}/assets/css/animate.min.css">
    <!-- Main Style CSS Link -->
    <link rel="stylesheet" href="{{asset('vendor/landing')}}/assets/css/style.css">
    @if($primaryColor || $secondaryColor)
        <style>
            :root {
                @if($primaryColor)
                    --primary-color: {{ $primaryColor }} !important;
                @endif

                @if($secondaryColor)
                    --secondary-color: {{ $secondaryColor }} !important;
               @endif
            }
        </style>
    @endif
    <style>
        .marquee-container {
            overflow: hidden;
            z-index: 999;
            position: relative;
        }

        .marquee-track {
            display: flex;
            width: fit-content;
            /*z-index: 999;*/
            animation: marquee 50s linear infinite;
        }

        .marquee-slide {
            min-width: 550px;
            height: 450px;
            background-size: cover;
            background-position: center;
            margin-right: 20px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
