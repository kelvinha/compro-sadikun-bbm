@extends('landing.layout.master')
@section('classBody', 'index_page')
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
        <!-- START OF HERO SECTION -->
        <section class="main-banner dark-bg">
            <div class="banner-stripes">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="banner-shape-wp wow fadeInLeft" data-wow-duration=".8s">
                <div class="banner-shape">
                    <span class="stripe"></span>
                    <span class="stripe stripe-secondary"></span>
                </div>
            </div>
            <div class="swiper main-banner-slider">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide main-banner-slide">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="banner-content white-text">
                                            <h1 class="h1-title">
                                                @php
                                                    $words = array_filter(explode(" ", trim($banner->title )));
                                                    $lastWord = end($words);

                                                    array_pop($words);
                                                    $remainingSentence = implode(" ", $words);
                                                @endphp
                                                {{ $remainingSentence  }}
                                                <span>
                                                {{ $lastWord }}
                                                <img src="{{asset('vendor/landing')}}/assets/images/title-line.svg"
                                                     width="342" height="13" alt="Title line">
                                            </span>
                                            </h1>
                                            <p class="text-lg">{{ $banner->description }}</p>
                                            <div class="banner-btn">
                                                <a href="{{ route('home.products') }}" class="sec-btn"
                                                   title="Discover More">Discover
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="banner-image-path-main">
                                            <div class="banner-image-path-sub">
                                                @if($banner->image)
                                                    <div class="banner-image back-img"
                                                         style="background-image: url('{{asset('storage/' . $banner->image)}}');">
                                                    </div>
                                                @else
                                                    <div class="banner-image back-img"
                                                         style="background-image: url('{{asset('vendor/landing')}}/assets/images/explore-work-3-min.jpg');">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END OF HERO SECTION -->
        <!-- START OF HERO SECTION -->
        <section class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-images wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="about-top-image back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/about-us-1.jpg');">
                                <span class="logo-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/logo-icon.svg" width="48"
                                         height="48" alt="Logo Icon">
                                </span>
                            </div>
                            <div class="about-bottom-image back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/about-us-2.jpg');"></div>
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
                                <p>Kami menyediakan layanan distribusi BBM industri yang efisien, aman, dan terpercaya.
                                    Dengan dukungan armada modern dan jaringan nasional, kami siap menjadi mitra energi
                                    terbaik bagi bisnis Anda.</p>
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
        <div class="col-lg-12">
            <div class="company-timeline wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                <span class="timeline-text">2012</span>
                <div class="company-experiance">
                    <img src="{{ asset('vendor/landing') }}/assets/images/plus-icon.svg" width="20" height="20"
                         alt="Plus Icon">
                    <div class="company-experiance-content">
                        <svg class="textcircle" viewbox="0 0 500 500">
                            <defs>
                                <path id="textcircle" d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z"></path>
                            </defs>
                            <text>
                                <textpath xlink:href="#textcircle" textlength="900">
                                    @php
                                        $since = date('Y') - 2012;
                                    @endphp
                                    {{ $since }} YEARS OF EXPERIANCE
                                </textpath>
                            </text>
                        </svg>
                    </div>
                </div>
                <span class="timeline-text">Since</span>
            </div>
        </div>
        <!-- END OF JOINING SECTION -->
        <!-- START OF SKILLS SECTION -->
        <section class="skills">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-lg-2">
                        <div id="counter" class="skills-content wow fadeInRight" data-wow-duration=".8s"
                             data-wow-delay=".2s">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    PROCESS & SKILLS
                                </span>
                                <h2 class="h2-title">Mengapa Memilih Sadikun BBM</h2>
                                <p>Kami hadir sebagai solusi energi terpadu dengan dedikasi terhadap layanan terbaik,
                                    distribusi terpercaya, dan dukungan pertumbuhan industri berkelanjutan.</p>
                            </div>
                            <div class="skills-progress">
                                <div class="skills-progress-box">
                                    <h6 class="h6-title">
                                        Quality Services
                                        <span>
                                            <span class="skill-count counting" data-count="95">0</span>%</span>
                                    </h6>
                                    <div class="skills-progressbar">
                                        <div class="skills-progressbar-thumb" style="width: 0%;" data-width="95%"></div>
                                    </div>
                                </div>
                                <div class="skills-progress-box">
                                    <h6 class="h6-title">
                                        Dedicated Team
                                        <span>
                                            <span class="skill-count counting" data-count="98">0</span>%</span>
                                    </h6>
                                    <div class="skills-progressbar">
                                        <div class="skills-progressbar-thumb" style="width: 0%;" data-width="98%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skills-counter">
                                <div class="skills-count projects-done">
                                    <div class="counting-wp">
                                        <div class="h3-title">
                                            <strong class="counting" data-count="10">0</strong>
                                            <span>+</span>
                                        </div>
                                        <span>Products Done</span>
                                    </div>
                                </div>
                                <div class="skills-count worker-team">
                                    <div class="counting-wp">
                                        <div class="h3-title">
                                            <strong class="counting" data-count="1000">0</strong>
                                            <span>+</span>
                                        </div>
                                        <span>Worker Team</span>
                                    </div>
                                </div>
                                <div class="skills-count satisfied-clients">
                                    <div class="counting-wp">
                                        <div class="h3-title">
                                            <strong class="counting" data-count="10">0</strong>
                                            <span>+</span>
                                        </div>
                                        <span>Satisfied Clients</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1 align-self-lg-center">
                        <div class="process-content-wp wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="process-item">
                                <div class="process-step">
                                    <p class="h4-title">1</p>
                                </div>
                                <div class="process-content">
                                    <h4 class="h4-title">Mulai dari Komitmen Energi</h4>
                                    <p>PT Sadikun BBM berdiri sejak 2012 sebagai distributor resmi Pertamina, siap
                                        memenuhi kebutuhan energi nasional.</p>
                                </div>
                            </div>
                            <div class="process-item">
                                <div class="process-step">
                                    <p class="h4-title">2</p>
                                </div>
                                <div class="process-content">
                                    <h4 class="h4-title">Bangun Jaringan Distribusin</h4>
                                    <p>Didukung jaringan nasional dan pengalaman lebih dari 10 tahun, kami menjangkau
                                        berbagai sektor industri secara andal.</p>
                                </div>
                            </div>
                            <div class="process-item">
                                <div class="process-step">
                                    <p class="h4-title">3</p>
                                </div>
                                <div class="process-content">
                                    <h4 class="h4-title">Kirim Energi Tepat Waktu</h4>
                                    <p>Dengan integritas dan kehandalan, kami pastikan energi sampai dengan aman dan
                                        tepat waktu ke seluruh Indonesia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF SKILLS SECTION -->
        <!-- START OF ACHIVEMENTS SECTION -->
        <section class="our-portfolio-01">
            <div class="container">
                <div class="col-lg-12 mb-5">
                    <div class="sec-title">
                    <span class="sub-title wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                        <img src="{{asset('vendor/landing')}}/assets/images/certified-engineer.svg" width="18"
                             height="18"
                             alt="Setting Icon">OUR JOURNEY
                    </span>
                        <h2 class="h2-title m-0 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">Milestones
                            We’ve Reached</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="our-work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/Award Sadikun BBM.jpeg');"></div>
                            <div class="our-work-content">
                                <div class="our-work-name">
                                    <h4 class="h4-title">
                                        <a title="Electronic Material">The Best Sales</a>
                                    </h4>
                                    <span class="work-category">2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="our-work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/Award Sadikun BBM-3.jpeg');"></div>
                            <div class="our-work-content">
                                <div class="our-work-name">
                                    <h4 class="h4-title">
                                        <a title="Electronic Material">Good Contribution Agen BBM Lintas Region</a>
                                    </h4>
                                    <span class="work-category">2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="our-work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/Award Sadikun BBM-5.jpeg');"></div>
                            <div class="our-work-content">
                                <div class="our-work-name">
                                    <h4 class="h4-title">
                                        <a title="Electronic Material">Best Pefomance</a>
                                    </h4>
                                    <span class="work-category">2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="our-work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/Award Sadikun BBM-4.jpeg');"></div>
                            <div class="our-work-content">
                                <div class="our-work-name">
                                    <h4 class="h4-title">
                                        <a title="Electronic Material">Best Perfomance Agent</a>
                                    </h4>
                                    <span class="work-category">2016</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="our-work-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="back-img"
                                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/Award Sadikun BBM-2.jpeg');"></div>
                            <div class="our-work-content">
                                <div class="our-work-name">
                                    <h4 class="h4-title">
                                        <a title="Electronic Material">Best Volume</a>
                                    </h4>
                                    <span class="work-category">2012</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF OUR ACHIVEMENTS SECTION -->
        <!-- START OF FAQ SECTION -->
        <section class="faq-section dark-bg">
            <div class="banner-shape">
                <span class="stripe"></span>
                <span class="stripe stripe-secondary"></span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-lg-1 order-2 align-self-center">
                        <div class="faq-content wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    FAQ
                                </span>
                                <h2 class="h2-title m-0">Do You Have Any Question ?</h2>
                            </div>
                            <div class="faq-accordian white-text">
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Apa itu Sadikun BBM?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Sadikun BBM merupakan perusahaan agen resmi dari Pertamina Patra Niaga dalam
                                            mensupply kebutuhan energi Anda.</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Apa saja produk yang ditawarkan?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Kami menawarkan berbagai jenis produk BBM <a
                                                href="{{ route('home.products') }}">lihat disini</a></p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Bagaimana cara melakukan pembelian produk BBM?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Anda dapat melakukan pembelian dengan menghubungi nomor whatsapp kami di
                                            0811-1030-322</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Apakah Sadikun BBM melayani pengiriman luar kota?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p> Kami melayani pengiriman dengan jangkauan pulau Jawa</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Apakah Sadikun BBM membuka peluang kerja sama atau
                                            partnership?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Kami membuka peluang kerja sama atau partnership, silahkan email ke <a
                                                href="mailto:marketing_official@sadikun.com"></a>marketing_official@sadikun.com
                                        </p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Bagaimana cara melamar kerja di Sadikun BBM?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Silahkan email ke <a href="mailto:marketing_official@sadikun.com"></a>marketing_official@sadikun.com
                                        </p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Bagaimana jika saya mengalami masalah dengan produk atau
                                            layanan?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Silahkan menghubungi kami pada whatsapp di 0811-1030-322</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-box">
                                    <div class="faq-accordian-title">
                                        <h6 class="h6-title">Bagaimana saya bisa mendapatkan informasi terbaru tentang
                                            Sadikun BBM?</h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="faq-accordian-content">
                                        <p>Anda dapat membuka media sosial kami di Instagram: @officialsadikun</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1">
                        <div class="in-touch-form wow fadeInRight" data-wow-duration=".8s" data-wow-delay=".2s">
                            <h3 class="h3-title">Get In Touch Now !</h3>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-field">
                                            <input type="text" class="input-field" placeholder="Full Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-field">
                                            <input type="email" class="input-field" placeholder="Email Address"
                                                   required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-field">
                                            <input type="number" class="input-field" placeholder="Phone No."
                                                   required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-field">
                                            <textarea name="message" class="input-field"
                                                      placeholder="Message..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-field form-submit-btn">
                                            <button type="submit" class="sec-btn">Submit now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF FAQ SECTION -->
        <!-- START OF TESTIMONIALS SECTION -->
        <section class="global-clients light-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 order-lg-1 order-2 align-self-center">
                        <div class="global-clients-list wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                            @foreach($clients as $client)
                                @if($client->logo)
                                    <img src="{{ asset('storage/' . $client->logo) }}" width="130" height="34" alt="Boltshift Icon">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-5 order-lg-2 order-1">
                        <div class="global-clients-content wow fadeInRight" data-wow-duration=".8s" data-wow-delay=".2s">
                            <div class="sec-title">
                                <span class="sub-title">
                                    <img src="{{ asset('vendor/landing') }}/assets/images/setting-icon.svg" width="18" height="18" alt="Setting Icon">
                                    TRUSTED BY
                                </span>
                                <h2 class="h2-title">Our {{ $clients->count() }} Clients</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="testimonials">
            <img src="{{asset('vendor/landing')}}/assets/images/globe.svg" class="bg-glob" width="687" height="744"
                 alt="Globe Icon">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title">
                            <span class="sub-title wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                     height="18" alt="Setting Icon">
                                TESTIMONIAL
                            </span>
                            <h2 class="h2-title m-0 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">What
                                Client Say About Us</h2>
                        </div>
                        <div class="swiper testimonial-slider wow fadeInUp" data-wow-duration=".8s"
                             data-wow-delay=".2s">
                            <div class="swiper-wrapper">
                                @foreach($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-box">
                                            <span class="quote_icon"></span>
                                            <div class="testimonial-author">
                                                @if($testimonial->image)
                                                    <div class="author-img">
                                                        <div class="back-img"
                                                             style="background-image: url('{{asset('storage/' . $testimonial->image)}}');"></div>
                                                    </div>
                                                @else
                                                    <div class="author-img">
                                                        <div class="back-img"
                                                             style="background-image: url('{{asset('vendor/landing')}}/assets/images/mark-john.jpg');"></div>
                                                    </div>
                                                @endif
                                                <div class="author-content">
                                                    <h4 class="h4-title">{{ $testimonial->name }}</h4>
                                                    <span>{{ $testimonial->company }}</span>
                                                </div>
                                            </div>
                                            <div class="testimonial-content">
                                                <div class="testimonial-text overflow-text" data-simplebar="">
                                                    <p>{{ $testimonial->quote }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="testimonial-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
