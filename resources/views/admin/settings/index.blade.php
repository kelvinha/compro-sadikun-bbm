@extends('admin.layout.master')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Website Settings</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="bd-example">
                            <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab"
                                        data-bs-target="#general" type="button" role="tab" aria-controls="general"
                                        aria-selected="true">
                                        <i class="ti ti-settings"></i> General
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                        aria-selected="false">
                                        <i class="ti ti-mail"></i> Contact
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="social-tab" data-bs-toggle="tab"
                                        data-bs-target="#social" type="button" role="tab" aria-controls="social"
                                        aria-selected="false">
                                        <i class="ti ti-brand-facebook"></i> Social Media
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                        type="button" role="tab" aria-controls="seo" aria-selected="false">
                                        <i class="ti ti-search"></i> SEO
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="footer-tab" data-bs-toggle="tab"
                                        data-bs-target="#footer" type="button" role="tab" aria-controls="footer"
                                        aria-selected="false">
                                        <i class="ti ti-layout-bottom"></i> Footer
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="language-tab" data-bs-toggle="tab"
                                        data-bs-target="#language" type="button" role="tab" aria-controls="language"
                                        aria-selected="false">
                                        <i class="ti ti-language"></i> Language
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="settingsTabsContent">
                                <!-- General Settings -->
                                <div class="tab-pane fade show active" id="general" role="tabpanel"
                                    aria-labelledby="general-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="website_name">Website Name</label>
                                                <input type="text" class="form-control" id="website_name"
                                                    name="settings[website_name]"
                                                    value="{{ $settings->where('key', 'website_name')->first()?->value }}">
                                                <small class="form-text text-muted">The name of your website</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="website_tagline">Website Tagline</label>
                                                <input type="text" class="form-control" id="website_tagline"
                                                    name="settings[website_tagline]"
                                                    value="{{ $settings->where('key', 'website_tagline')->first()?->value }}">
                                                <small class="form-text text-muted">A short description of your
                                                    website</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="website_logo">Website Logo</label>
                                                <div class="custom-file-upload">
                                                    <input type="file" class="form-control file-upload-input"
                                                        id="website_logo" name="website_logo" accept="image/*">
                                                    <div class="file-upload-preview mt-2">
                                                        @if ($settings->where('key', 'website_logo')->first()?->value)
                                                        <img src="{{ asset('storage/' . $settings->where('key', 'website_logo')->first()->value) }}"
                                                            alt="Website Logo" class="img-thumbnail"
                                                            style="max-height: 100px;">
                                                        <span class="file-name">{{ basename($settings->where('key',
                                                            'website_logo')->first()->value) }}</span>
                                                        @else
                                                        <div class="no-file">No logo uploaded</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">The logo of your website
                                                    (recommended size: 200x60px)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="website_favicon">Website Favicon</label>
                                                <div class="custom-file-upload">
                                                    <input type="file" class="form-control file-upload-input"
                                                        id="website_favicon" name="website_favicon"
                                                        accept="image/x-icon,image/png,image/jpeg">
                                                    <div class="file-upload-preview mt-2">
                                                        @if ($settings->where('key',
                                                        'website_favicon')->first()?->value)
                                                        <img src="{{ asset('storage/' . $settings->where('key', 'website_favicon')->first()->value) }}"
                                                            alt="Website Favicon" class="img-thumbnail"
                                                            style="max-height: 50px;">
                                                        <span class="file-name">{{ basename($settings->where('key',
                                                            'website_favicon')->first()->value) }}</span>
                                                        @else
                                                        <div class="no-file">No favicon uploaded</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">The favicon of your website
                                                    (recommended size: 32x32px)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="primary_color">Primary Color</label>
                                                <div class="pickr-container">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control color-input"
                                                            id="primary_color" name="settings[primary_color]"
                                                            value="{{ $settings->where('key', 'primary_color')->first()?->value ?? '#171A7C' }}">
                                                        <span class="input-group-text p-0">
                                                            <div id="primary_color_pickr" class="pickr-button"></div>
                                                        </span>
                                                    </div>
                                                    <div class="color-preview mt-2"
                                                        style="background-color: {{ $settings->where('key', 'primary_color')->first()?->value ?? '#171A7C' }}">
                                                        <span class="color-name">{{ $settings->where('key',
                                                            'primary_color')->first()?->value ?? '#171A7C' }}</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">The primary color for your
                                                    website</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="secondary_color">Secondary Color</label>
                                                <div class="pickr-container">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control color-input"
                                                            id="secondary_color" name="settings[secondary_color]"
                                                            value="{{ $settings->where('key', 'secondary_color')->first()?->value ?? '#F7A400' }}">
                                                        <span class="input-group-text p-0">
                                                            <div id="secondary_color_pickr" class="pickr-button">
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="color-preview mt-2"
                                                        style="background-color: {{ $settings->where('key', 'secondary_color')->first()?->value ?? '#F7A400' }}">
                                                        <span class="color-name">{{ $settings->where('key',
                                                            'secondary_color')->first()?->value ?? '#F7A400' }}</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">The secondary color for your
                                                    website</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="admin_email">Admin Email</label>
                                                <input type="email" class="form-control" id="admin_email"
                                                    name="settings[admin_email]"
                                                    value="{{ $settings->where('key', 'admin_email')->first()?->value }}">
                                                <small class="form-text text-muted">The email address of the website
                                                    administrator</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Settings -->
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="contact_email">Contact Email</label>
                                                <input type="email" class="form-control" id="contact_email"
                                                    name="settings[contact_email]"
                                                    value="{{ $settings->where('key', 'contact_email')->first()?->value }}">
                                                <small class="form-text text-muted">The email address for contact
                                                    inquiries</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="contact_phone">Contact Phone</label>
                                                <input type="text" class="form-control" id="contact_phone"
                                                    name="settings[contact_phone]"
                                                    value="{{ $settings->where('key', 'contact_phone')->first()?->value }}">
                                                <small class="form-text text-muted">The phone number for contact
                                                    inquiries</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="contact_address">Contact Address</label>
                                                <textarea class="form-control" id="contact_address"
                                                    name="settings[contact_address]"
                                                    rows="3">{{ $settings->where('key', 'contact_address')->first()?->value }}</textarea>
                                                <small class="form-text text-muted">The physical address of your
                                                    company</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Media Settings -->
                                <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="social_facebook">Facebook URL</label>
                                                <input type="url" class="form-control" id="social_facebook"
                                                    name="settings[social_facebook]"
                                                    value="{{ $settings->where('key', 'social_facebook')->first()?->value }}">
                                                <small class="form-text text-muted">Your Facebook page URL</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="social_twitter">Twitter URL</label>
                                                <input type="url" class="form-control" id="social_twitter"
                                                    name="settings[social_twitter]"
                                                    value="{{ $settings->where('key', 'social_twitter')->first()?->value }}">
                                                <small class="form-text text-muted">Your Twitter profile URL</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="social_instagram">Instagram URL</label>
                                                <input type="url" class="form-control" id="social_instagram"
                                                    name="settings[social_instagram]"
                                                    value="{{ $settings->where('key', 'social_instagram')->first()?->value }}">
                                                <small class="form-text text-muted">Your Instagram profile URL</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="social_linkedin">LinkedIn URL</label>
                                                <input type="url" class="form-control" id="social_linkedin"
                                                    name="settings[social_linkedin]"
                                                    value="{{ $settings->where('key', 'social_linkedin')->first()?->value }}">
                                                <small class="form-text text-muted">Your LinkedIn profile URL</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="social_youtube">YouTube URL</label>
                                                <input type="url" class="form-control" id="social_youtube"
                                                    name="settings[social_youtube]"
                                                    value="{{ $settings->where('key', 'social_youtube')->first()?->value }}">
                                                <small class="form-text text-muted">Your YouTube channel URL</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEO Settings -->
                                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea class="form-control" id="meta_description"
                                                    name="settings[meta_description]"
                                                    rows="3">{{ $settings->where('key', 'meta_description')->first()?->value }}</textarea>
                                                <small class="form-text text-muted">The meta description for your
                                                    website</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <textarea class="form-control" id="meta_keywords"
                                                    name="settings[meta_keywords]"
                                                    rows="3">{{ $settings->where('key', 'meta_keywords')->first()?->value }}</textarea>
                                                <small class="form-text text-muted">The meta keywords for your
                                                    website</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="og_image">OG Image</label>
                                                <input type="file" class="form-control" id="og_image"
                                                    name="settings[og_image]">
                                                <small class="form-text text-muted">The Open Graph image for your
                                                    website</small>
                                                @if ($settings->where('key', 'og_image')->first()?->value)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings->where('key', 'og_image')->first()->value) }}"
                                                        alt="OG Image" class="img-thumbnail" style="max-height: 100px;">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="google_analytics_id">Google Analytics ID</label>
                                                <input type="text" class="form-control" id="google_analytics_id"
                                                    name="settings[google_analytics_id]"
                                                    value="{{ $settings->where('key', 'google_analytics_id')->first()?->value }}">
                                                <small class="form-text text-muted">Your Google Analytics tracking
                                                    ID</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer Settings -->
                                <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="footer_text">Footer Text</label>
                                                <textarea class="form-control" id="footer_text"
                                                    name="settings[footer_text]"
                                                    rows="3">{{ $settings->where('key', 'footer_text')->first()?->value }}</textarea>
                                                <small class="form-text text-muted">The text to display in the
                                                    footer</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="footer_scripts">Footer Scripts</label>
                                                <textarea class="form-control" id="footer_scripts"
                                                    name="settings[footer_scripts]"
                                                    rows="5">{{ $settings->where('key', 'footer_scripts')->first()?->value }}</textarea>
                                                <small class="form-text text-muted">Scripts to include in the
                                                    footer</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Language Settings -->
                                <div class="tab-pane fade" id="language" role="tabpanel" aria-labelledby="language-tab">
                                    <div class="row mt-4">
                                        <!-- Enable Multilingual -->
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="multilingual_enabled">Enable Multilingual</label>
                                                <select class="form-control" id="multilingual_enabled"
                                                    name="settings[multilingual_enabled]">
                                                    <option value="0" {{ $settings->where('key',
                                                        'multilingual_enabled')->first()?->value == '0' ? 'selected' :
                                                        '' }}>
                                                        No</option>
                                                    <option value="1" {{ $settings->where('key',
                                                        'multilingual_enabled')->first()?->value == '1' ? 'selected' :
                                                        '' }}>
                                                        Yes</option>
                                                </select>
                                                <small class="form-text text-muted">Enable multilingual support for the
                                                    website</small>
                                            </div>
                                        </div>

                                        <!-- Default Language -->
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="default_language">Default Language</label>
                                                <select class="form-control" id="default_language"
                                                    name="settings[default_language]">
                                                    @php
                                                    $defaultLang =
                                                    $settings->where('key', 'default_language')->first()
                                                    ?->value ?? 'en';
                                                    $availableLanguages = json_decode(
                                                    $settings->where('key', 'available_languages')->first()
                                                    ?->value ?? '{"en":"English","id":"Indonesian"}',
                                                    true,
                                                    );
                                                    @endphp
                                                    @foreach ($availableLanguages as $code => $name)
                                                    <option value="{{ $code }}" {{ $defaultLang==$code ? 'selected' : ''
                                                        }}>
                                                        {{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Select the default language for the
                                                    website</small>
                                            </div>
                                        </div>

                                        <!-- Available Languages -->
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label>Available Languages</label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Language Code</th>
                                                                <th>Language Name</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="language-list">
                                                            @foreach ($availableLanguages as $code => $name)
                                                            <tr>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        name="language_codes[]" value="{{ $code }}"
                                                                        required>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        name="language_names[]" value="{{ $name }}"
                                                                        required>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm remove-language"
                                                                        data-bs-toggle="tooltip" title="Remove">
                                                                        <i class="ti ti-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        id="add-language">
                                                        <i class="ti ti-plus"></i> Add Language
                                                    </button>
                                                </div>
                                                <small class="form-text text-muted">Configure available languages for
                                                    the website</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Save Settings</button>
                        </div>

                        <script>
                            $(document).ready(function() {
                                    // Function to validate and format color
                                    function validateAndFormatColor(color) {
                                        // Check if it's a valid hex color
                                        var isHex = /^#?([0-9A-F]{3}){1,2}$/i.test(color);

                                        if (isHex) {
                                            // Add # if missing
                                            if (color[0] !== '#') {
                                                color = '#' + color;
                                            }
                                            // Convert 3-digit hex to 6-digit
                                            if (color.length === 4) {
                                                color = '#' + color[1] + color[1] + color[2] + color[2] + color[3] + color[3];
                                            }
                                            return color;
                                        }
                                        return null;
                                    }

                                    // Initialize Pickr for primary color
                                    const primaryPickr = Pickr.create({
                                        el: '#primary_color_pickr',
                                        theme: 'nano',
                                        default: $('#primary_color').val() || '#171A7C',
                                        swatches: [
                                            '#171A7C', '#F7A400', '#1c582c', '#dc3545', '#fd7e14', '#ffc107',
                                            '#28a745', '#20c997', '#17a2b8', '#6610f2', '#6f42c1', '#e83e8c'
                                        ],
                                        components: {
                                            preview: true,
                                            opacity: false,
                                            hue: true,
                                            interaction: {
                                                hex: true,
                                                rgba: false,
                                                hsla: false,
                                                hsva: false,
                                                cmyk: false,
                                                input: true,
                                                clear: false,
                                                save: true
                                            }
                                        },
                                        i18n: {
                                            'btn:save': 'Apply'
                                        }
                                    });

                                    // Initialize Pickr for secondary color
                                    const secondaryPickr = Pickr.create({
                                        el: '#secondary_color_pickr',
                                        theme: 'nano',
                                        default: $('#secondary_color').val() || '#F7A400',
                                        swatches: [
                                            '#171A7C', '#F7A400', '#1c582c', '#dc3545', '#fd7e14', '#ffc107',
                                            '#28a745', '#20c997', '#17a2b8', '#6610f2', '#6f42c1', '#e83e8c'
                                        ],
                                        components: {
                                            preview: true,
                                            opacity: false,
                                            hue: true,
                                            interaction: {
                                                hex: true,
                                                rgba: false,
                                                hsla: false,
                                                hsva: false,
                                                cmyk: false,
                                                input: true,
                                                clear: false,
                                                save: true
                                            }
                                        },
                                        i18n: {
                                            'btn:save': 'Apply'
                                        }
                                    });

                                    // Handle primary color changes
                                    primaryPickr.on('save', (color, instance) => {
                                        const hexColor = color.toHEXA().toString();
                                        $('#primary_color').val(hexColor);
                                        $('#primary_color').closest('.pickr-container').find('.color-preview').css(
                                            'background-color', hexColor);
                                        $('#primary_color').closest('.pickr-container').find('.color-name').text(hexColor);
                                        instance.hide();
                                    });

                                    // Handle secondary color changes
                                    secondaryPickr.on('save', (color, instance) => {
                                        const hexColor = color.toHEXA().toString();
                                        $('#secondary_color').val(hexColor);
                                        $('#secondary_color').closest('.pickr-container').find('.color-preview').css(
                                            'background-color', hexColor);
                                        $('#secondary_color').closest('.pickr-container').find('.color-name').text(hexColor);
                                        instance.hide();
                                    });

                                    // Handle manual input for primary color
                                    $('#primary_color').on('input', function() {
                                        const value = $(this).val().trim();
                                        const formattedColor = validateAndFormatColor(value);
                                        if (formattedColor) {
                                            $(this).val(formattedColor);
                                            $(this).closest('.pickr-container').find('.color-preview').css('background-color',
                                                formattedColor);
                                            $(this).closest('.pickr-container').find('.color-name').text(formattedColor);
                                            primaryPickr.setColor(formattedColor);
                                            $(this).removeClass('is-invalid').addClass('is-valid');
                                        } else {
                                            $(this).removeClass('is-valid').addClass('is-invalid');
                                        }
                                    });

                                    // Handle manual input for secondary color
                                    $('#secondary_color').on('input', function() {
                                        const value = $(this).val().trim();
                                        const formattedColor = validateAndFormatColor(value);
                                        if (formattedColor) {
                                            $(this).val(formattedColor);
                                            $(this).closest('.pickr-container').find('.color-preview').css('background-color',
                                                formattedColor);
                                            $(this).closest('.pickr-container').find('.color-name').text(formattedColor);
                                            secondaryPickr.setColor(formattedColor);
                                            $(this).removeClass('is-invalid').addClass('is-valid');
                                        } else {
                                            $(this).removeClass('is-valid').addClass('is-invalid');
                                        }
                                    });

                                    // Copy color to clipboard on double click
                                    $('.color-preview').dblclick(function() {
                                        const colorValue = $(this).closest('.pickr-container').find('.color-input').val();
                                        navigator.clipboard.writeText(colorValue).then(function() {
                                            toastr.success('Color code copied to clipboard!');
                                        });
                                    });
                                });

                                // Initialize file upload previews
                                $('.file-upload-input').on('change', function() {
                                var $input = $(this);
                                var $preview = $input.closest('.custom-file-upload').find('.file-upload-preview');

                                if ($input[0].files && $input[0].files[0]) {
                                    var file = $input[0].files[0];
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        $preview.html('<img src="' + e.target.result +
                                            '" class="img-thumbnail" style="max-height: 100px;"><span class="file-name">' +
                                            file.name + '</span>');
                                    };

                                    reader.readAsDataURL(file);
                                }
                                });
                                });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            // Initialize color pickers
            $('input[name="settings[primary_color]"], input[name="settings[secondary_color]"]').each(function() {
                var $input = $(this);
                var $container = $input.closest('.color-picker-container');
                var $swatch = $container.find('.color-swatch');

                $input.spectrum({
                    preferredFormat: "hex",
                    showInput: true,
                    showInitial: true,
                    allowEmpty: false,
                    showPalette: true,
                    showSelectionPalette: true,
                    maxSelectionSize: 10,
                    palette: [
                        ['#4361ee', '#7239ea', '#2dce89', '#e63757', '#fb6340']
                    ],
                    change: function(color) {
                        $swatch.css('background-color', color.toHexString());
                    }
                });

                // Set initial swatch color
                $swatch.css('background-color', $input.val());
            });

            // Add new language row
            document.getElementById('add-language').addEventListener('click', function() {
                const tbody = document.getElementById('language-list');
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>
                    <input type="text" class="form-control" name="language_codes[]" required>
                </td>
                <td>
                    <input type="text" class="form-control" name="language_names[]" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-language" data-bs-toggle="tooltip" title="Remove">
                        <i class="ti ti-trash"></i>
                    </button>
                </td>
            `;
                tbody.appendChild(tr);
            });

            // Remove language row
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-language')) {
                    const row = e.target.closest('tr');
                    if (document.querySelectorAll('#language-list tr').length > 1) {
                        row.remove();
                    } else {
                        alert('You must keep at least one language.');
                    }
                }
            });

            // Update default language options when languages change
            function updateDefaultLanguageOptions() {
                const defaultLanguageSelect = document.getElementById('default_language');
                const currentValue = defaultLanguageSelect.value;
                const codes = Array.from(document.getElementsByName('language_codes[]')).map(input => input.value);
                const names = Array.from(document.getElementsByName('language_names[]')).map(input => input.value);

                defaultLanguageSelect.innerHTML = '';
                codes.forEach((code, index) => {
                    if (code && names[index]) {
                        const option = new Option(names[index], code, false, code === currentValue);
                        defaultLanguageSelect.appendChild(option);
                    }
                });
            }

            document.getElementById('language-list').addEventListener('input', updateDefaultLanguageOptions);
            document.getElementById('add-language').addEventListener('click', () => setTimeout(
                updateDefaultLanguageOptions, 0));
        });
</script>
@endsection