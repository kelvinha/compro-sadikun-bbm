@php
    $settings = \App\Helpers\SettingsHelper::getPublic();
    $data = [];

    foreach ($settings as $setting) {
        if ($setting->key === 'website_logo') {
            $data['website_logo'] = $setting->value;
        }
    }
@endphp
    <!-- START OF LOADER -->
<div class="loader-box">
    @if($data['website_logo'])
        <img src="{{asset('storage/' . $data['website_logo'])}}" alt="Loader Main">
    @else
        <div class="loader">
            <img src="{{asset('vendor/landing')}}/assets/images/logo-fill.svg" width="165" height="134"
                 alt="Loader Main">
        </div>
    @endif
</div>
<!-- LOADER END -->
