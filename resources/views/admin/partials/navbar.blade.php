<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ url('/admin') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                @if (\App\Helpers\SettingsHelper::get('admin_logo'))
                <img src="{{ asset('storage/' . \App\Helpers\SettingsHelper::get('admin_logo')) }}"
                    style="max-width: 100%; max-height: 40px;"
                    alt="{{ \App\Helpers\SettingsHelper::get('website_name', config('app.name')) }}" />
                @elseif(\App\Helpers\SettingsHelper::get('website_logo'))
                <img src="{{ asset('storage/' . \App\Helpers\SettingsHelper::get('website_logo')) }}"
                    style="max-width: 100%; max-height: 40px;"
                    alt="{{ \App\Helpers\SettingsHelper::get('website_name', config('app.name')) }}" />
                @else
                <img src="{{ asset('logo.png') }}" style="max-width: 100%; max-height: 40px;"
                    alt="{{ \App\Helpers\SettingsHelper::get('website_name', config('app.name')) }}" />
                @endif
                <span class="badge bg-light-primary rounded-pill ms-2 theme-version">CMS</span>
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="user-avtar wid-45 rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <small class="text-muted">{{ Auth::user()->role ? Auth::user()->role->display_name : 'User'
                                }}</small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink"><svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg></a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="{{ route('admin.profile.index') }}"
                                class="{{ request()->routeIs('admin.profile.index') ? 'active' : '' }}"><i
                                    class="ti ti-user"></i>
                                <span>My Profile</span></a>
                            <a href="{{ route('admin.profile.change-password') }}"
                                class="{{ request()->routeIs('admin.profile.change-password') ? 'active' : '' }}"><i
                                    class="ti ti-lock"></i>
                                <span>Change Password</span></a>
                            <a href="{{ route('sign-out') }}"><i class="ti ti-power"></i>
                                <span>Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Dashboard</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-presentation-chart"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="{{ url('/admin') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-dashboard"></i></span><span class="pc-mtext">Dashboard</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.analytics.index') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-chart-bar"></i></span><span class="pc-mtext">Analytics</span></a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-settings"></i></span><span
                            class="pc-mtext">Content Management</span><span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.pages.index') }}">Pages</a></li>
                        {{-- <li class="pc-item"><a class="pc-link" href="{{ route('admin.menus.index') }}">Menus</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.submenus.index') }}">Submenus</a> --}}
                        </li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.teams.index') }}">Team Members</a>
                        </li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.blog-categories.index') }}">Blog
                                Categories</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.media.index') }}">Media Library</a>
                        </li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.banners.index') }}">Banners</a>
                        </li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.clients.index') }}">Clients</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-caption">
                    <label>E-commerce</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-shopping-bag"></use>
                    </svg>
                </li>
                {{-- <li class="pc-item">
                    <a href="{{ route('admin.services.index') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-tool"></i></span><span class="pc-mtext">Services</span></a>
                </li> --}}
                <li class="pc-item">
                    <a href="{{ route('admin.products.index') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-box"></i></span><span class="pc-mtext">Services</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.product-categories.index') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-list"></i></span><span class="pc-mtext">Product Categories</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.projects.index') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-building"></i></span><span class="pc-mtext">Projects</span></a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Communication</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-message"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.contact-messages.index') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-mail"></i></span><span class="pc-mtext">Contact Messages</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.newsletter-subscribers.index') }}" class="pc-link"><span
                            class="pc-micon"><i class="ti ti-mail-forward"></i></span><span class="pc-mtext">Newsletter
                            Subscribers</span></a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Settings</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-setting-2"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="{{ url('/admin/settings') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-settings"></i></span><span class="pc-mtext">Website Settings</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ url('/admin/seo') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-search"></i></span><span class="pc-mtext">SEO Settings</span></a>
                </li>

                @if (auth()->user()->isSuperAdmin())
                <li class="pc-item pc-caption">
                    <label>Administration</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-shield"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="{{ url('/admin/users') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-users"></i></span><span class="pc-mtext">Users</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ url('/admin/roles') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-key"></i></span><span class="pc-mtext">Roles</span></a>
                </li>
                <li class="pc-item">
                    <a href="{{ url('/admin/permissions') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-lock"></i></span><span class="pc-mtext">Permissions</span></a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>