@extends('landing.layout.master')
@section('classBody', 'contact_us_page')
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
        <section class="inner-banner back-img"
                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/banner.jpg');">
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
                                <h2 class="h1-title">Contact Us</h2>
                            </div>
                            <div class="inner-banner-breadcrumb wow fadeInUp" data-wow-duration=".8s"
                                 data-wow-delay=".2s">
                                <ul>
                                    <li>
                                        <a href="index.html" title="Home">Home</a>
                                    </li>
                                    <li>
                                        <span>Contact Us</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF MAIN BANNER -->
        <section class="contact-main">
            <div class="contact-offices">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-office wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s" style="height: 230px;">
                                <h4 class="h4-title">Main Office</h4>
                                <ul>
                                    <li>
                                        <a href="tel:{{ $contactInfo['phone'] }}" title="Call on +62 213 864 386">
                                            <img src="{{asset('vendor/landing')}}/assets/images/phone-icon.svg"
                                                 width="18" height="18" alt="Phone Icon">
                                            <span>{{ $contactInfo['phone'] }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:{{ $contactInfo['email'] }}"
                                           title="Mail on marketing_official@sadikun.com">
                                            <img src="{{asset('vendor/landing')}}/assets/images/mail-icon.svg"
                                                 width="18" height="13"
                                                 alt="Mail Icon">
                                            <span>{{ $contactInfo['email'] }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://maps.app.goo.gl/ybuuJrh7x4fdod3w9" title="8/05 Mozilla Golden"
                                           target="_blank">
                                            <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                 width="15" height="20" alt="Map Icon">
                                            <span>Central Jakarta, Senen</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6" style="height: 150px;">
                            <div class="contact-office wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <h4 class="h4-title">Our Retail Office</h4>
                                <div class="row">
                                    <div class="col-3">
                                        <ul>
                                            <li>
                                                <a href="https://maps.app.goo.gl/LmWVkPgA84hJv5PeA" title="bandung"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Bandung</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://maps.app.goo.gl/MkWgVEyir24yANEh8" title="cikupa"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Cikupa</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href=https://maps.app.goo.gl/UCaVaTVVNVVhdeRK6" title="cilegon"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Cilegon</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-3">
                                        <ul>
                                            <li>
                                                <a href="https://maps.app.goo.gl/xyzWz2SWEa81EEAL9" title="denpasar"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Denpasar</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://maps.app.goo.gl/Ut86CTAdqrBbHBJP9" title="Pinangsia"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Pinangsia</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://maps.app.goo.gl/gbBFTSXaBgW78hPe8" title="Surabaya"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Surabaya</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-3">
                                        <ul>
                                            <li>
                                                <a href="https://maps.app.goo.gl/YAm9QEygKP1avYzy7" title="Tambun"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Tambun</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://maps.app.goo.gl/ZeTgFwAnFnLFFBt8A" title="Walang"
                                                   target="_blank">
                                                    <img src="{{asset('vendor/landing')}}/assets/images/map-pin-transparent.svg"
                                                         width="15" height="20" alt="Map Icon">
                                                    <span>Walang</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-contact">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 order-lg-1 order-2">
                            <div class="main-contact-map wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".2s">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.686441261886!2d106.83749607498997!3d-6.172719993814645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5ca63fc59bf%3A0x9fba725575f2db77!2sEra%20Tower!5e0!3m2!1sen!2sid!4v1748449635484!5m2!1sen!2sid"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-6 order-lg-2 order-1">
                            <div class="main-contact-form wow fadeInRight" data-wow-duration=".8s" data-wow-delay=".2s">
                                <div class="sec-title">
                                    <span class="sub-title">
                                        <img src="{{asset('vendor/landing')}}/assets/images/setting-icon.svg" width="18"
                                             height="18" alt="Setting Icon">
                                        CONTACT US
                                    </span>
                                    <h2 class="h2-title">Let Start The Smart Work !</h2>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-field">
                                                <input type="text" class="input-field" placeholder="Full Name"
                                                       required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-field">
                                                <input type="email" class="input-field" placeholder="Email Address"
                                                       required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
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
            </div>
        </section>
    </main>
@endsection
