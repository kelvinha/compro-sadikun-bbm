@extends('landing.layout.master')
@section('classBody', 'about_us')
@section('content')
    <main class="site-main">
        <!-- START OF INNER BANNER -->
        <section class="inner-banner back-img"
                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/about_us_intro_2.jpg');">
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
                                <h1 class="h1-title">About Us</h1>
                            </div>
                            <div class="inner-banner-breadcrumb wow fadeInUp" data-wow-duration=".8s"
                                 data-wow-delay=".2s">
                                <ul>
                                    <li>
                                        <a href="{{ route("home.index") }}" title="Home">Home</a>
                                    </li>
                                    <li>
                                        <span>About Us</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF INNER BANNER -->
        <!-- START OF ABOUT US -->
        <section class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-images wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="about-top-image back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/about_us_intro.jpg');">
                                <span class="logo-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/logo-icon.svg" width="48"
                                         height="48" alt="Logo Icon">
                                </span>
                            </div>
                            <div class="about-bottom-image back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/about_us_intro_2.jpg');"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-us-content wow fadeInRight" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    ABOUT US
                                </span>
                                <h2 class="h2-title">Kami Hadirkan Solusi Energi Terpadu untuk Industri</h2>
                                <p>Kami menyediakan layanan distribusi BBM industri yang efisien, aman, dan terpercaya. Dengan dukungan armada modern dan jaringan nasional, kami siap menjadi mitra energi terbaik bagi bisnis Anda..</p>
                            </div>
                            <div class="engineer-list">
                                <div class="engineer-list-item">
                                    <span class="engineer-list-icon">
                                        <img src="{{asset('vendor/landing')}}/assets/images/expert-engineer.svg"
                                             width="35" height="43" alt="Expert Engineer Logo">
                                    </span>
                                    <div class="engineer-list-content">
                                        <h4 class="h4-title">Distributor Resmi Pertamina</h4>
                                        <p>PT Sadikun BBM merupakan distributor resmi Pertamina sejak 31 Mei 2012 dan
                                            bagian dari Sadikun Niagamas Raya.</p>
                                    </div>
                                </div>
                                <div class="engineer-list-item">
                                    <span class="engineer-list-icon">
                                        <img src="{{asset('vendor/landing')}}/assets/images/certified-engineer.svg"
                                             width="33" height="45" alt="Certified Engineer Logo">
                                    </span>
                                    <div class="engineer-list-content">
                                        <h4 class="h4-title">Pengalaman Lebih dari 10 Tahun</h4>
                                        <p> Dengan pengalaman lebih dari satu dekade, kami berkomitmen memberikan
                                            layanan energi terbaik dan terpercaya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF ABOUT US -->
        <!-- START OF NEW INNOVATIONS -->
        <div class="marquee-text-wp">
            <div class="marquee-text wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                <span class="h1-title">We Are Your Energy Partner</span>
                <span class="h1-title">We Are Your Energy Partner</span>
            </div>
            <div class="marquee-text wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                <span class="h1-title">We Are Your Energy Partner</span>
                <span class="h1-title">We Are Your Energy Partner</span>
            </div>
        </div>
        <!-- START OF NEW INNOVATIONS -->
        <!-- START OF HOW WE WORK -->
        <section class="how-we-work light-bg">
            <div class="container">
                <div class="sec-title text-center wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                    <span class="sub-title">
                        <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18" height="18"
                             alt="Setting Icon">
                        OUR PROCESS
                    </span>
                    <h2 class="h2-title">See How We Work</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <span>01</span>
                            <h4 class="h4-title">Analisis Kebutuhan Energi Industri</h4>
                            <p>Kami memahami kebutuhan akan distribusi energi BBM yang andal dan terpercaya di
                                Indonesia.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <span>02</span>
                            <h4 class="h4-title">Rancang Jaringan Distribusi</h4>
                            <p>Kami merancang solusi distribusi energi yang aman, tepat waktu, dan terintegrasi
                                nasional..</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <span>03</span>
                            <h4 class="h4-title">Menyalurkan Energi Secara Profesional</h4>
                            <p> Dengan nilai integritas dan konsistensi, kami memastikan pengiriman energi berjalan
                                optimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF HOW WE WORK -->
        <!-- START OF JOIN INDUSTRY -->
        <section class="join-us wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="join-us-content dark-bg">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    JOIN NOW
                                </span>
                                <h3 class="h3-title">Join The Future Of Industry Now</h3>
                            </div>
                            <div style="height: 100%; width: 100%;"></div>
                            <a href="https://wa.me/6281288062737?text=Halo%21%20Saya%20menemukan%20kontak%20ini%20dari%20website%20dan%20tertarik%20dengan%20layanan%2Fproduk%20yang%20ditawarkan.%20Boleh%20minta%20informasi%20lebih%20lengkapnya%3F%20Terima%20kasih%20sebelumnya." target="_blank" class="sec-btn ml-5" title="CONTACT US">CONTACT US</a>
                            <div class="banner-shape">
                                <span class="stripe"></span>
                                <span class="stripe stripe-secondary"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF JOIN INDUSTRY -->
        <!-- START OF INNOVATIONS -->
        <section class="why-choose">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="why-choose-content wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    WHY CHOOSE US
                                </span>
                                <h2 class="h2-title">Solusi Distribusi Energi yang Andal & Terpercaya</h2>
                            </div>
                            <p>Kami hadir sebagai mitra strategis untuk memenuhi kebutuhan energi BBM industri secara
                                efisien dan aman. Didukung oleh armada terintegrasi dan tim berpengalaman, kami siap
                                menyalurkan energi ke seluruh penjuru negeri.</p>
                            <ul>
                                <li>
                                    <span>Menyediakan layanan distribusi BBM industri dengan jangkauan nasional</span>
                                </li>
                                <li>
                                    <span>Armada dan peralatan modern untuk menjamin pengiriman yang cepat dan aman</span>
                                </li>
                                <li>
                                    <span>Komitmen terhadap integritas, kualitas layanan, dan kepuasan pelanggan</span>
                                </li>
                            </ul>
{{--                            <a href="{{ route('home.products') }}" class="sec-btn" title="Discover More">Discover More</a>--}}
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-lg-center">
                        <div class="why-choose-image-wp wow fadeInRight" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="row">
                                <div class="col-8">
                                    <div class="why-choose-image why-choose-1 back-img"
                                         style="background-image: url('{{asset('vendor/landing')}}/assets/images/why-choose-us-1.jpg');"></div>
                                </div>
                                <div class="col-4 align-self-center">
                                    <div class="why-choose-image why-choose-2 back-img"
                                         style="background-image: url('{{asset('vendor/landing')}}/assets/images/why-choose-us-2.jpg');"></div>
                                </div>
                                <div class="col-12">
                                    <div class="why-choose-image why-choose-3 back-img"
                                         style="background-image: url('{{asset('vendor/landing')}}/assets/images/why-choose-us-3.jpg');"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF INNOVATIONS -->
        <!-- START OF TESTIMONIALS -->
{{--        <section class="testimonials dark-bg">--}}
{{--            <img src="{{asset('vendor/landing')}}/assets/images/globe.svg" class="bg-glob" width="687" height="744"--}}
{{--                 alt="Globe Icon">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="sec-title">--}}
{{--                            <span class="sub-title wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">--}}
{{--                                <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"--}}
{{--                                     height="18" alt="Setting Icon">--}}
{{--                                TESTIMONIAL--}}
{{--                            </span>--}}
{{--                            <h2 class="h2-title m-0 wow fadeInUp text-white" data-wow-duration=".8s" data-wow-delay=".2s">What--}}
{{--                                Client Say About Us</h2>--}}
{{--                        </div>--}}
{{--                        <div class="swiper testimonial-slider wow fadeInUp" data-wow-duration=".8s"--}}
{{--                             data-wow-delay=".2s">--}}
{{--                            <div class="swiper-wrapper">--}}
{{--                                @foreach($testimonials as $testimonial)--}}
{{--                                    <div class="swiper-slide">--}}
{{--                                        <div class="testimonial-box">--}}
{{--                                            <span class="quote_icon"></span>--}}
{{--                                            <div class="testimonial-author">--}}
{{--                                                @if($testimonial->image)--}}
{{--                                                    <div class="author-img">--}}
{{--                                                        <div class="back-img"--}}
{{--                                                             style="background-image: url('{{asset('storage/' . $testimonial->image)}}');"></div>--}}
{{--                                                    </div>--}}
{{--                                                @else--}}
{{--                                                    <div class="author-img">--}}
{{--                                                        <div class="back-img"--}}
{{--                                                             style="background-image: url('{{asset('vendor/landing')}}/assets/images/mark-john.jpg');"></div>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                                <div class="author-content">--}}
{{--                                                    <h4 class="h4-title">{{ $testimonial->name }}</h4>--}}
{{--                                                    <span>{{ $testimonial->company }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="testimonial-content">--}}
{{--                                                <div class="testimonial-text overflow-text" data-simplebar="">--}}
{{--                                                    <p>{{ $testimonial->quote }}</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                            <div class="testimonial-pagination"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- END OF TESTIMONIALS -->
        <!-- START OF WE ARE GLOBAL -->
        <section class="we-are-global">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="world-map-wp wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="world-map">
                                <img src="{{asset('vendor/landing')}}/assets/images/indonesia-map.png" width="899"
                                     height="537" alt="World map">
                                <span class="banten"></span>
                                <span class="jakarta"></span>
                                <span class="jabar"></span>
                                <span class="jatim"></span>
                                <span class="bali"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-lg-center">
                        <div class="global-content wow fadeInRight" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    Powering Your Journey for Every Mile
                                </span>
                                <h2 class="h2-title">Serving over 1000+ clients</h2>
                            </div>
                            <p>Didukung oleh kepercayaan lebih dari 1000 pelanggan di seluruh Indonesia, kami berkomitmen menghadirkan layanan yang profesional dengan mengedepankan kualitas, keandalan, serta integritas tinggi,
                                sehingga bisa menjadi mitra strategis Anda dalam mendukung kemajuan industri nasional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF WE ARE GLOBAL -->
        <!-- START OF BLOG SECTION -->
{{--        <section class="blog-section">--}}
{{--            <div class="container">--}}
{{--                <div class="sec-title wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">--}}
{{--                    <span class="sub-title">--}}
{{--                        <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18" height="18"--}}
{{--                             alt="Setting Icon">--}}
{{--                        OUR BLOG--}}
{{--                    </span>--}}
{{--                    <h2 class="h2-title m-0">Latest Blog & News</h2>--}}
{{--                </div>--}}
{{--                <div class="blog-box-wp">--}}
{{--                    <div class="row justify-content-center">--}}
{{--                        @foreach($currentBlogs as $currentBlog)--}}
{{--                            <div class="col-lg-4 col-md-6">--}}
{{--                                <div class="blog-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">--}}
{{--                                    <div class="blog-image">--}}
{{--                                        @if($currentBlog->featured_image)--}}
{{--                                            <a href="{{ route('home.blog.post', $currentBlog->slug) }}" class="back-img"--}}
{{--                                               style="background-image: url('{{asset('storage/' . $currentBlog->featured_image)}}');"--}}
{{--                                               title="{{ $currentBlog->title }}"></a>--}}
{{--                                        @else--}}
{{--                                            <a href="{{ route('home.blog.post', $currentBlog->slug) }}" class="back-img"--}}
{{--                                               style="background-image: url('{{asset('vendor/landing')}}/assets/images/default-blog-image.svg');"--}}
{{--                                               title="{{ $currentBlog->title }}"></a>--}}
{{--                                        @endif--}}
{{--                                        <p class="blog-published">{{ $currentBlog->published_at->format('l, j F Y')  }}</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="blog-box-content">--}}
{{--                                        <h4 class="h4-title">--}}
{{--                                            <a href="{{ route('home.blog.post', $currentBlog->slug) }}"--}}
{{--                                               title="{{ $currentBlog->title }}">{{ $currentBlog->title }}</a>--}}
{{--                                        </h4>--}}
{{--                                        <p>{{ $currentBlog->excerpt  }}</p>--}}
{{--                                        <a href="{{ route('home.blog.post', $currentBlog->slug) }}" class="sec-btn"--}}
{{--                                           title="{{ $currentBlog->excerpt  }}"></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- END OF BLOG SECTION -->
    </main>
@endsection
