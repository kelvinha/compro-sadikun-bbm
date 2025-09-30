@extends('landing.layout.master')

@section('title', $transportsPage->seo->title ?? 'Our Transportir')
@section('meta_description', $transportsPage->seo->description ?? 'Discover reliable transportir solutions for fuel, liquid, and industrial product distribution. Supported by valve automation, control systems, and high safety standards to ensure efficiency and reliability.')
@section('meta_keywords', $transportsPage->seo->keywords ?? 'transportir, transportir system, valve automation, distribution control, fuel distribution, industrial transportir, liquid transport, control systems, pipeline transport, valve control')

@section('classBody', 'services_listing_page')
@section('content')
    <main class="site-main">
        <!-- START OF BANNER -->
        <section class="inner-banner back-img"
                 style="background-image: url('{{asset('vendor/landing')}}/assets/images/section-transportir.png');">
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
                                <h1 class="h1-title">Our Transportir</h1>
                            </div>
                            <div class="inner-banner-breadcrumb wow fadeInUp" data-wow-duration=".8s"
                                 data-wow-delay=".2s">
                                <ul>
                                    <li>
                                        <a href="{{ route('home.index') }}" title="Home">Home</a>
                                    </li>
                                    <li>
                                        <span>Transportir</span>
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
                    @foreach($transports as $transport)
                        <div class="col-lg-6 col-xxl-6 col-sm-6">
                            <div class="services-box wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
                                <div class="services-image">
                                    @if($transport->image)
                                        <div class="back-img"
                                             style="background-image: url('{{asset('storage/' . $transport->image)}}');"></div>
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
                                        $title = $transport->title;
                                    @endphp

                                    <div style="height: 130px;">
                                        <h4 class="h4-title">
                                            <a href="{{ route('home.services.transportir.show', $transport->slug) }}"
                                               title="{{ $title }}">
                                                {{ Str::limit($title, $maxLength, strlen($title) > $maxLength ? '...' : '') }}
                                            </a>
                                        </h4>
                                    </div>
{{--                                    {!! $transport->short_description !!}--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END OF SERVICES LISTING -->
    </main>
@endsection
