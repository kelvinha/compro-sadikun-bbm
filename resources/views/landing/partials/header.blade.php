<!-- START OF HEADER -->
@php
       $settings = \App\Helpers\SettingsHelper::getPublic();
       $data = [];

       foreach ($settings as $setting) {
           switch ($setting->key) {
               case 'contact_email':
                   $data['contact_email'] = $setting->value;
                   break;
               case 'contact_phone':
                   $data['contact_phone'] = $setting->value;
                   break;
                case 'website_logo':
                   $data['website_logo'] = $setting->value;
                   break;
           }
       }
@endphp
<header id="site_header" class="site-header">
    <div class="header-top" style="background-color: #ffffff;">
        <div class="container">
            <div class="top-hader-main-box black-text">
                <p class="m-0">Welcome to PT Sadikun BBM</p>
                <ul class="header-social">
                    @if(isset($data['contact_email']))
                        <li>
                            <a href="mailto:{{ $data['contact_email'] }}"
                               title="Mail on {{ $data['contact_email'] }}">
                                <img src="{{asset('vendor/landing')}}/assets/images/mail-icon.svg" width="18"
                                     height="13"
                                     alt="Mail Icon">
                                <span>{{ $data['contact_email'] }}</span>
                            </a>
                        </li>
                    @endif
                    @if(isset($data['contact_phone']))
                        <li>
                            <a href="tel:{{$data['contact_phone']}}" title="Call on {{$data['contact_phone']}}">
                                <img src="{{asset('vendor/landing')}}/assets/images/phone-icon.svg" width="18"
                                     height="18"
                                     alt="Phone Icon">
                                <span>{{$data['contact_phone']}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="heder-main" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="site-branding">
                        <a href="{{ route('home.index') }}" title="PT Sadikun BBM">
                            @if($data['website_logo'])
                                <img src="{{ asset('storage/' . $data['website_logo']) }}" width="152" height="35"
                                     alt="PT Sadikun Niagamas Raya Logo">
                            @else
                                <img src="{{asset('vendor/landing')}}/assets/images/logo.svg" width="152" height="35"
                                     alt="PT Sadikun Niagamas Raya Logo">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header-menu">
                        <nav class="main-navigation">
                            <button class="menu-toggle for-mob-flex">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <div class="header-mobile-menu">
                                <ul class="main-menu">
                                    @php
                                        // Load main menu directly in the header
                                        $mainMenu = \App\Helpers\MenuHelper::getMainMenu();
                                        $currentPath = "/". Request::path();
                                    @endphp

                                    @if($mainMenu && $mainMenu->submenus && $mainMenu->submenus->count() > 0)
                                        @foreach($mainMenu->submenus as $submenu)
                                            <li class="{{ $currentPath === $submenu->url || Request::path() === $submenu->url ? 'active-menu' : '' }}">
                                                <a href="{{ $submenu->url }}"
                                                   title="{{ $submenu->name }}">{{ $submenu->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="header-cta">
                                    <div class="header-search-button">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                                            <img src="{{asset('vendor/landing')}}/assets/images/search-icon.svg"
                                                 width="20" height="20" alt="Search Icon">
                                        </button>
                                    </div>
                                    <a href="https://wa.me/6281288062737?text=Halo%21%20Saya%20menemukan%20kontak%20ini%20dari%20website%20dan%20tertarik%20dengan%20layanan%2Fproduk%20yang%20ditawarkan.%20Boleh%20minta%20informasi%20lebih%20lengkapnya%3F%20Terima%20kasih%20sebelumnya." target="_blank" class="sec-btn"
                                       title="CONTACT US">CONTACT US</a>
                                </div>
                            </div>
                        </nav>
                        <div class="black-shadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END OF HEADER -->
