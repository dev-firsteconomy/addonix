@php
    $setting = App\Models\Utility::colorset();
    // $color = 'theme-3';
    // if (!empty($setting['color'])) {
    //     $color = $setting['color'];
    // }
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $lang = Utility::getValByName('default_language');

    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_favicon = Utility::getValByName('company_favicon');
    $setting = Utility::settings();
    $company_logo = \App\Models\Utility::GetLogo();
    $seo_setting = App\Models\Utility::getSeoSetting();

    // dd($setting);
    // @dd($logo);
    $footer_text = isset(\App\Models\Utility::settings()['footer_text']) ? \App\Models\Utility::settings()['footer_text'] : '';
@endphp
<!DOCTYPE html>
{{-- @dd($setting['SITE_RTL']); --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $setting['SITE_RTL'] == 'on' ? 'rtl' : '' }}">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Salesy Saas- Business Sales CRM" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />
    <title>
        {{ Utility::getValByName('header_text') ? Utility::getValByName('header_text') : config('app.name', 'Salesy SaaS') }}
        - @yield('page-title')</title>
    <!-- Primary Meta Tags -->

    <meta name="title" content="{{ $seo_setting['meta_keywords'] }}">
    <meta name="description" content="{{ $seo_setting['meta_description'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $seo_setting['meta_keywords'] }}">
    <meta property="og:description" content="{{ $seo_setting['meta_description'] }}">
    <meta property="og:image" content="{{ asset('uploads/metaevent/' . $seo_setting['meta_image']) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $seo_setting['meta_keywords'] }}">
    <meta property="twitter:description" content="{{ $seo_setting['meta_description'] }}">
    <meta property="twitter:image" content="{{ asset('uploads/metaevent/' . $seo_setting['meta_image']) }}">
    <link rel="icon" href="{{ $logo . '/favicon.png' }}" type="image/png">


    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('public/libs/@fortawesome/fontawesome-free/css/all.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/css/site.css') }}" id="stylesheet">
    <!-- vendor css -->

    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    @if ($setting['SITE_RTL'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif
    @if (isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @endif

</head>

<body class="{{ $color }}">
    <div class="auth-wrapper auth-v3">
        <div class="bg-auth-side bg-primary"></div>
        <div class="auth-content">
            <nav class="navbar navbar-expand-md navbar-light default">
                <div class="container-fluid pe-2">
                    <a class="" href="#">
                        {{-- <img src="{{ asset(Storage::url('logo/'.$logo)) }}" alt="{{ env('APP_NAME') }}" class="logo logo-lg" /> --}}
                        <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                            alt="logo" class="logo logo-lg nav-sidebar-logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                        <ul class="navbar-nav align-items-center ms-auto ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Support</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Terms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Privacy</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @yield('language-bar')
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')

            <div class="auth-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            {{-- <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="logo"> --}}
                            <p class="text-mute">{{ $footer_text }} </p>
                        </div>
                        <div class="col-6 text-end">
                            {{-- <p class="text-white">© 2022, made with love for a better web. </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('assets/js/vendor-all.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
@if ($setting['enable_cookie'] == 'on')
    @include('layouts.cookie_consent')
@endif

@stack('custom-scripts')

</html>
