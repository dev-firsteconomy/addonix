

@extends('layouts.admin')
@php
    $profile=\App\Models\Utility::get_file('/'.config('chatify.user_avatar.folder'));
@endphp
@push('css-page')
@include('Chatify::layouts.headLinks')
@endpush
@section('page-title')
    {{__('Messenger')}}
@endsection
@section('title')
      {{__('Messenger')}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Messenger')}}</li>
@endsection
@php
$setting = App\Models\Utility::colorset();
$color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
@endphp
@section('content')
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="messenger mt-4">
                {{-- ----------------------Users/Groups lists side---------------------- --}}
                <div class="messenger-listView">
                    {{-- Header and search bar --}}
                    <div class="m-header">
                        <nav>
                        <nav class="m-header-right">
                                <a href="#" class="listView-x"><i class="ti ti-times"></i></a>
                            </nav>
                        </nav>
                        {{-- Search input --}}
                        <input type="text" class="messenger-search" placeholder="Search" />
                        {{-- Tabs --}}
                        <div class="messenger-listView-tabs">
                                <a href="#" @if($type == 'user') class="active-tab" @endif data-view="users">
                                    <span class="ti ti-clock" title="{{__('Recent')}}"></span>
                                </a>
                                <a href="#" @if($type == 'group') class="active-tab" @endif data-view="groups">
                                    <span class="ti ti-users" title="{{__('Members')}}"></span></a>
                            </div>
                    </div>
                    {{-- tabs and lists --}}
                    <div class="m-body">
                    {{-- Lists [Users/Group] --}}
                    {{-- ---------------- [ User Tab ] ---------------- --}}
                    <div class="@if($type == 'user') show @endif messenger-tab app-scroll" data-view="users">
                        {{-- Favorites --}}
                        <div class="favorites-section">
                            <p class="messenger-title">Favorites</p>
                            <div class="messenger-favorites app-scroll-thin"></div>
                        </div>
                        {{-- Saved Messages --}}
                        {!! view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render() !!}
                        {{-- Contact --}}
                        <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>
                    </div>
                    {{-- ---------------- [ Group Tab ] ---------------- --}}
                        <div class="all_members @if($type == 'group') show @endif messenger-tab app-scroll" data-view="groups">
                            {{-- items --}}
                            
                            <p style="text-align: center;color:grey;">{{__('Soon will be available')}}</p>
                        </div>
                        {{-- ---------------- [ Search Tab ] ---------------- --}}
                    <div class=" messenger-tab app-scroll" data-view="search">
                            {{-- items --}}
                            <p class="messenger-title">Search</p>
                            <div class="search-records">
                                <p class="message-hint center-el"><span>Type to search..</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ----------------------Messaging side---------------------- --}}
                <div class="messenger-messagingView">
                    {{-- header title [conversation name] amd buttons --}}
                    <div class="m-header m-header-messaging">
                        <nav>
                            {{-- header back button, avatar and user name --}}
                            <div style="display: inline-flex;">
                                <a href="#" class="show-listView"><i class="ti ti-arrow-left"></i></a>
                                @if(!empty(Auth::user()->avatar))
                                {{-- @dd($profile.'/'.Auth::user()->avatar) --}}
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px; background-image: url('{{ $profile.'/'.Auth::user()->avatar }}');">
                                </div>
                                @else
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('{{ asset('/storage/avatars/avatar.png') }}');"></div>
                                @endif
                                <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                            </div>
                            {{-- header buttons --}}
                            <nav class="m-header-right">
                                <a href="#" class="add-to-favorite my-lg-1 my-xl-1 mx-lg-1 mx-xl-1"><i class="fas fa-star"></i></a>
                                <a href="#" class="show-infoSide my-lg-1 my-xl-1 mx-lg-1 mx-xl-2"><i class="fas fa-info-circle"></i></a>
                            </nav>
                        </nav>
                    </div>
                    {{-- Internet connection --}}
                    <div class="internet-connection">
                        <span class="ic-connected">Connected</span>
                        <span class="ic-connecting">Connecting...</span>
                        <span class="ic-noInternet">Please add pusher settings for using messenger.</span>
                    </div>
                    {{-- Messaging area --}}
                    <div class="m-body app-scroll">
                        <div class="messages">
                            <p class="message-hint" style="margin-top: calc(30% - 126.2px);"><span>Please select a chat to start messaging</span></p>
                        </div>
                        {{-- Typing indicator --}}
                        <div class="typing-indicator">
                            <div class="message-card typing">
                                <p>
                                    <span class="typing-dots">
                                        <span class="dot dot-1"></span>
                                        <span class="dot dot-2"></span>
                                        <span class="dot dot-3"></span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        {{-- Send Message Form --}}
                        @include('Chatify::layouts.sendForm')
                    </div>
                </div>
                {{-- ---------------------- Info side ---------------------- --}}
                <div class="messenger-infoView app-scroll text-center1" >
                    {{-- nav actions --}}
                    <nav class="text-center">
                        <a href="#"><i class="fas fa-times"></i></a>
                    </nav>
                    {!! view('Chatify::layouts.info')->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-page')
    @include('Chatify::layouts.modals')
@endpush
@if($color == "theme-1")
<style type="text/css">
    .m-list-active, .m-list-active:hover, .m-list-active:focus {
    background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459D !important;
}
.mc-sender p {
    background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459D !important;
}
.messenger-favorites div.avatar {
    box-shadow: 0px 0px 0px 2px #51459D !important;
}
.messenger-listView-tabs a, .messenger-listView-tabs a:hover, .messenger-listView-tabs a:focus {
    color:  #51459D !important;
}
.m-header svg {
    color: #51459D !important;
}
.active-tab {
    border-bottom: 2px solid  #51459D !important;
}
.messenger-infoView nav a {
    color: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459D !important;
}
.lastMessageIndicator {
    color: #51459D !important;
}
.messenger-list-item td span .lastMessageIndicator {
    color: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459D !important;
    font-weight: bold;
}
.messenger-sendCard button svg {
     color: #51459D !important;
}
.m-header a, .m-header a:hover, .m-header a:focus {
 color: ##606679 !important;
}
/* .fas .fa-paper-plane{
 color: #6FD943 !important;
} */
.messenger-sendCard button span {
 color: #51459D !important;
}
</style>
@endif
@if($color == "theme-2")
<style type="text/css">
    .m-list-active, .m-list-active:hover, .m-list-active:focus {
    background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, #4EBBD3 99.86%), #1F3996 !important;
}
.mc-sender p {
    background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, #4EBBD3 99.86%), #1F3996 !important;
}
.messenger-favorites div.avatar {
    box-shadow: 0px 0px 0px 2px #1F3996 !important;
}
.messenger-listView-tabs a, .messenger-listView-tabs a:hover, .messenger-listView-tabs a:focus {
    color:  #1F3996 !important;
}
.m-header svg {
    color: #1F3996 !important;
}
.active-tab {
    border-bottom: 2px solid  #1F3996 !important;
}
.messenger-infoView nav a {
    color: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, #4EBBD3 99.86%), #1F3996 !important;
}
.lastMessageIndicator {
    color: #1F3996 !important;
}
.messenger-list-item td span .lastMessageIndicator {
    color: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, #4EBBD3 99.86%), #1F3996 !important;
    font-weight: bold;
}
.messenger-sendCard button svg {
     color: #1F3996 !important;
}
.m-header a, .m-header a:hover, .m-header a:focus {
 color: ##606679 !important;
}
/* .fas .fa-paper-plane{
 color: #1F3996 !important;
} */
.messenger-sendCard button span {
 color: #1F3996 !important;
}
</style>
@endif
@if($color == "theme-3")
<style type="text/css">
    .m-list-active, .m-list-active:hover, .m-list-active:focus {
    background: linear-gradient(141.55deg, #6FD943 3.46%, #6FD943 99.86%), #6FD943 !important;
}
.mc-sender p {
    background: linear-gradient(141.55deg, #6FD943 3.46%, #6FD943 99.86%), #6FD943 !important;
}
.messenger-favorites div.avatar {
    box-shadow: 0px 0px 0px 2px #6FD943 !important;
}
.messenger-listView-tabs a, .messenger-listView-tabs a:hover, .messenger-listView-tabs a:focus {
    color: #6FD943 !important;
}
.m-header svg {
    color: #6FD943 !important;
}
.active-tab {
    border-bottom: 2px solid  #6FD943 !important;
}
.messenger-infoView nav a {
    color: linear-gradient(141.55deg, #6FD943 3.46%, #6FD943 99.86%), #6FD943 !important;
}
.lastMessageIndicator {
    color: #6FD943 !important;
}
.messenger-list-item td span .lastMessageIndicator {
    color: linear-gradient(141.55deg, #6FD943 3.46%, #6FD943 99.86%), #6FD943 !important;
    font-weight: bold;
}
.messenger-sendCard button svg {
     color: #6FD943 !important;
}
.m-header a, .m-header a:hover, .m-header a:focus {
    color: ##606679 !important;
}
/* .fas .fa-paper-plane{
    color: #6FD943 !important;
} */
.messenger-sendCard button span {
    color: #6FD943 !important;
}
</style>
@endif
@if($color == "theme-4")
<style type="text/css">
    .m-list-active, .m-list-active:hover, .m-list-active:focus {
    background:linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #685EE5 99.86%), #584ED2 !important;
}
.mc-sender p {
    background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #685EE5 99.86%), #584ED2 !important;
}
.messenger-favorites div.avatar {
    box-shadow: 0px 0px 0px 2px #584ED2 !important;
}
.messenger-listView-tabs a, .messenger-listView-tabs a:hover, .messenger-listView-tabs a:focus {
    color:  #584ED2 !important;
}
.m-header svg {
    color: #584ED2 !important;
}
.active-tab {
    border-bottom: 2px solid #584ED2 !important;
}
.messenger-infoView nav a {
    color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #685EE5 99.86%), #584ED2 !important;
}
.lastMessageIndicator {
    color: #584ED2 !important;
}
.messenger-list-item td span .lastMessageIndicator {
    color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #685EE5 99.86%), #584ED2 !important;
    font-weight: bold;
}
.messenger-sendCard button svg {
     color: #584ED2 !important;
}
.m-header a, .m-header a:hover, .m-header a:focus {
 color: ##606679 !important;
}
/* .fas .fa-paper-plane{
 color: #584ED2 !important;
} */
.messenger-sendCard button span {
 color: #584ED2 !important;
}
</style>
@endif