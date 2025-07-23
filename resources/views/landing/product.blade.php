@extends('landing.layout.master')

@section('title', $productsPage->seo->title ?? 'Our Products')
@section('meta_description', $productsPage->seo->description ?? 'Explore our range of high-quality products')
@section('meta_keywords', $productsPage->seo->keywords ?? 'products, valve automation, control systems')

@section('classBody', 'services_listing_page')
@section('content')
    <main class="site-main">
        <!-- START OF BANNER -->
        <section class="inner-banner back-img"
                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/banner-our-product.png');">
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
                                <h1 class="h1-title">Our Products</h1>
                            </div>
                            <div class="inner-banner-breadcrumb wow fadeInUp" data-wow-duration=".8s"
                                 data-wow-delay=".2s">
                                <ul>
                                    <li>
                                        <a href="{{ route('home.index') }}" title="Home">Home</a>
                                    </li>
                                    <li>
                                        <span>Products</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF BANNER -->
        <!-- START OF SERVICES LISTING -->
        <section class="main-services-grid">
            <div class="container">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-6 col-xxl-3 col-sm-4">
                            <div class="services-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <div class="services-image">
                                    @if($product->image)
                                        <div class="back-img"
                                             style="background-image: url('{{asset('storage/' . $product->image)}}'); background-size: contain;"></div>
                                    @else
                                        <div class="back-img"
                                             style="background-image: url('{{asset('vendor/landing')}}/assets/images/service-list-card-1.jpg');"></div>
                                    @endif
                                </div>
                                <div class="services-box-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/all-maintenance-icon.svg" width="38" height="38" alt="All Maintenance Icon">
                                </div>
                                <div class="services-box-content">
                                    @php
                                        $maxLength = 40;
                                        $title = $product->title;
                                    @endphp

                                    <div style="height: 130px;">
                                        <h4 class="h4-title">
                                            <a href="{{ route('home.products.show', $product->slug) }}" target="_blank"
                                               title="{{ $title }}">
                                                {{ Str::limit($title, $maxLength, strlen($title) > $maxLength ? '...' : '') }}
                                            </a>
                                        </h4>
                                    </div>
{{--                                    {!! $product->short_description !!}--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END OF SERVICES LISTING -->
        <!-- START OF OUR WORK SECTION -->
        <section class="our-work">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="our-work-content-wp">
                            <div class="sec-title wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <span class="sub-title">
                                    <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                         height="18" alt="Setting Icon">
                                    Gallery
                                </span>
                                <h2 class="h2-title m-0">Explore Our Work</h2>
                            </div>
{{--                            <div class="more-work">--}}
{{--                                <a href="portfolio.html" class="sec-btn wow fadeInUp" data-wow-duration=".8s"--}}
{{--                                   data-wow-delay=".2s" title="Discover More">Discover More</a>--}}
{{--                            </div>--}}
                            <div class="our-work-slider-wp wow fadeInUp marquee-container" data-wow-duration=".8s" data-wow-delay=".2s">
                                <div class="marquee-track">
                                    @php
                                        $images = [
                                            'gallery-1.jpg',
                                            'gallery-2.jpg',
                                            'gallery-3.jpg',
                                            'gallery-4.jpg',
                                            'gallery-5.jpg',
                                            'gallery-6.jpg',
                                        ];
                                    @endphp

                                    @foreach(array_merge($images, $images) as $img)
                                        <div class="marquee-slide"
                                             style="background-image: url('{{ asset("vendor/landing/assets/images/$img") }}');">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
{{--                            <div class="our-work-slider-wp wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">--}}
{{--                                <div class="swiper our-work-slider">--}}
{{--                                    <div class="swiper-wrapper">--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <div class="our-work-box">--}}
{{--                                                <div class="back-img"--}}
{{--                                                     style="background-image: url('{{asset('vendor/landing')}}/assets/images/gallery-1.jpg');"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <div class="our-work-box">--}}
{{--                                                <div class="back-img"--}}
{{--                                                     style="background-image: url('{{asset('vendor/landing')}}/assets/images/gallery-2.jpg');"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <div class="our-work-box">--}}
{{--                                                <div class="back-img"--}}
{{--                                                     style="background-image: url('{{asset('vendor/landing')}}/assets/images/gallery-3.jpg');"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <div class="our-work-box">--}}
{{--                                                <div class="back-img"--}}
{{--                                                     style="background-image: url('{{asset('vendor/landing')}}/assets/images/gallery-4.jpg');">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <div class="our-work-box">--}}
{{--                                                <div class="back-img"--}}
{{--                                                     style="background-image: url('{{asset('vendor/landing')}}/assets/images/gallery-5.jpg');">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <div class="our-work-box">--}}
{{--                                                <div class="back-img"--}}
{{--                                                     style="background-image: url('{{asset('vendor/landing')}}/assets/images/gallery-6.jpg');">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF OUR WORK SECTION -->
        <!-- START OF QUALITY SECTION -->
        <section class="best-quality">
            <div class="container">
                <div class="sec-title text-center wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                    <h2 class="h2-title">We Are Your Energy Partner</h2>
                </div>
                <div class="sec-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="best-quality-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <span class="quality-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/all-maintenance-icon.svg"
                                         width="38" height="38" alt="All Maintenance Icon">
                                </span>
                                <div class="quality-content">
                                    <h4 class="h4-title">Distribusi BBM Industri</h4>
                                    <p>Sadikun BBM menyediakan bahan bakar minyak untuk kebutuhan industri dengan
                                        distribusi yang cepat, aman, dan terpercaya di setiap titik kebutuhan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="best-quality-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <span class="quality-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/general-contract-icon.svg"
                                         width="33" height="37" alt="General Contract Icon">
                                </span>
                                <div class="quality-content">
                                    <h4 class="h4-title">Pasokan BBM Industri</h4>
                                    <p>Berkomitmen menjaga ketersediaan produk dalam berbagai kapasitas sesuai kebutuhan
                                        Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="best-quality-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <span class="quality-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/automobiles-icon.svg" width="35"
                                         height="35" alt="Automobiles Icon">
                                </span>
                                <div class="quality-content">
                                    <h4 class="h4-title">Solusi Energi Terintegrasis</h4>
                                    <p>Kami menawarkan solusi lengkap dari pengadaan, pengelolaan, hingga efisiensi
                                        energi untuk berbagai kebutuhan bisnis dan industri</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="best-quality-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <span class="quality-icon">
                                    <img src="{{asset('vendor/landing')}}/assets/images/mechanical-parts-icon.svg"
                                         width="35" height="35" alt="Mechanical Parts Icon">
                                </span>
                                <div class="quality-content">
                                    <h4 class="h4-title">Layanan Konsultasi Energi</h4>
                                    <p>Tim ahli kami siap membantu Anda merancang strategi energi yang hemat biaya dan
                                        ramah lingkungan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF QUALITY SECTION -->
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
    </main>
@endsection
