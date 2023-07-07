@php
$users = \Auth::user();
// $profile = asset(Storage::url('upload/profile/'));
$profile=\App\Models\Utility::get_file('upload/profile/');
$unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
    ->where('seen', 0)
    ->count();
@endphp

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <header class="dash-header transprent-bg">
@else
    <header class="dash-header">
@endif
    <div class="header-wrapper w-100">
        <div class="dash-mob-drp w-100">
            <ul class="list-unstyled w-100 d-flex">
                <li class="dash-h-item mob-hamburger">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                        data-target="#sidenav-main"></a>
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- <li class="dropdown dash-h-item">
                        <a class="dash-head-link dropdown-toggle arrow-none ms-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
                                </div>
                            </form>
                        </div> --}}

                <li class="dropdown dash-h-item drp-company ms-auto">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="theme-avtar">
                            @if(\Request::route()->getName() == 'chats' )
                            <img class="rounded-circle" src="{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" style="width:30px;">
                            @else
                            <img class="rounded-circle" src="{{$profile}}{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" style="width:30px;">
                            @endif
                        </span>
                        <span class="hide-mob ms-2">{{ __('Hi') }}, {{ $users->name }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                        {{-- @if (\Auth::user()->type == 'owner')
                            <a href="{{ url('chats') }}" class="dropdown-item">
                                <i class="ti ti-message"></i>
                                <span>Message</span>
                            </a>
                            @endif --}}
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- <div class="ms-auto">
            <ul class="list-unstyled">
                @if (\Auth::user()->type != 'super admin')
                    <li class="dash-h-item">
                        <a href="{{ url('chats') }}" class="dash-head-link me-0">
                            <i class="ti ti-message-circle " style="font-size: 21px"></i>
                            <span class="bg-danger dash-h-badge message-counter custom_messanger_counter">{{ $unseenCounter }}<span
                                    class="sr-only"></span>
                            </span>
                        </a>
                    </li>
                @endif
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob">{{ Str::upper($currantLang) }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        @foreach ($languages as $language)
                            <a href="{{ route('change.language', $language) }}" class="dropdown-item @if ($language==$currantLang) active-language text-primary @endif">
                                <span> {{ Str::upper($language) }}</span>
                            </a>
                        @endforeach
                        @if (Auth::user()->type == 'super admin')
                            <a href="{{ route('manage.language', [$currantLang]) }}"
                                class="dropdown-item border-top py-1 text-primary">
                                <span class="small">{{ __('Manage Languages') }}</span>
                            </a>
                        @endif
                    </div>
                </li>
            </ul>
        </div> -->
    </div>
</header>
