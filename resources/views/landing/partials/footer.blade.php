<!-- START OF FOOTER -->
@php
    $settings = \App\Helpers\SettingsHelper::getPublic();
    $data = [];

    foreach ($settings as $setting) {
        switch ($setting->key) {
            case 'social_facebook':
                $data['social_facebook'] = $setting->value;
                break;
            case 'social_twitter':
                $data['social_twitter'] = $setting->value;
                break;
            case 'social_instagram':
                $data['social_instagram'] = $setting->value;
                break;
            case 'social_linkedin':
                $data['social_linkedin'] = $setting->value;
                break;
            case 'social_youtube':
                $data['social_youtube'] = $setting->value;
                break;
            case 'website_logo':
                $data['website_logo'] = $setting->value;
                break;
            case 'contact_email':
                $data['contact_email'] = $setting->value;
                break;
            case 'contact_phone':
                $data['contact_phone'] = $setting->value;
                break;
            case 'contact_address':
                $data['contact_address'] = $setting->value;
                break;
        }
    }
@endphp
<footer class="site-footer black-text" style="background-color: #FFFFFF;">
    <div class="top-footer">
        <div class="banner-shape">
            <span class="stripe"></span>
            <span class="stripe stripe-secondary"></span>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-left">
                        <div class="footer-branding">
                            <a href="{{ route('home.index') }}" title="PT Sadikun BBM">
                                @if($data['website_logo'])
                                    <img src="{{ asset('storage/' . $data['website_logo']) }}" width="152" height="35"
                                         alt="PT Sadikun Niagamas Raya Logo">
                                @else
                                    <img src="{{asset('vendor/landing')}}/assets/images/logo.svg" width="152" height="35"
                                         alt="PT Sadikun Niagamas Raya Logo">
                                @endif
                            </a>
                            <p>Empowering Indonesia with reliable, innovative, and heartfelt energy solutions</p>
                        </div>
                        <div class="footer-socials">
                            <ul>
                                @if (!empty($data['social_facebook']))
                                    <li>
                                        <a href="{{ $data['social_facebook'] }}" title="Follow on Facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif

                                @if (!empty($data['social_instagram']))
                                    <li>
                                        <a href="{{ $data['social_instagram'] }}" title="Follow on Instagram" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                @endif

                                @if (!empty($data['social_linkedin']))
                                    <li>
                                        <a href="{{ $data['social_linkedin'] }}" title="Follow on Linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-links">
                        <h4 class="h4-title">Our Links</h4>
                        <ul>
                            @php
                                // Load main menu directly in the header
                                $mainMenu = \App\Helpers\MenuHelper::getMainMenu();
                                $currentPath = "/". Request::path();
                            @endphp

                            @if($mainMenu && $mainMenu->submenus && $mainMenu->submenus->count() > 0)
                                @foreach($mainMenu->submenus as $submenu)
                                    <li class="{{ $currentPath === $submenu->url || Request::path() === $submenu->url ? 'active-footer-menu' : '' }}">
                                        <a href="{{ $submenu->url }}"
                                           title="{{ $submenu->name }}">{{ $submenu->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-contact">
                        <h4 class="h4-title">Contact Us</h4>
                        <ul>
                            <li>
                                <div class="contact-item">
                                        <span class="contact-icon">
                                            <i class="fas fa-map-marker-alt" style="color: #FFFFFF;"></i>
                                        </span>
                                    <div class="contact-link">
                                        <a href="https://maps.app.goo.gl/ZwA6bivb8dijZNoAA" title="{{ $data['contact_address'] }}" target="_blank">{{ $data['contact_address'] }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact-item">
                                        <span class="contact-icon">
                                            <i class="fas fa-envelope" style="color: #FFFFFF;"></i>
                                        </span>
                                    <div class="contact-link">
                                        <a href="mailto:{{ $data['contact_email'] }}"
                                           title="Mail on {{ $data['contact_email'] }}">{{ $data['contact_email'] }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact-item">
                                        <span class="contact-icon">
                                            <i class="fas fa-phone-alt" style="color: #FFFFFF;"></i>
                                        </span>
                                    <div class="contact-link">
                                        <a href="tel:{{ $data['contact_phone'] }}" title="Call on {{ $data['contact_phone'] }}">
                                            {{ $data['contact_phone'] }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="bottom-footer-content">
                <p class="bottom-footer-text m-0">
                    Copyright © <span id="copy-right-year">{{ date('Y')  }}</span>
                    All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- END OF FOOTER -->
