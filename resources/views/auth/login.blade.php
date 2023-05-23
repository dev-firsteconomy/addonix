@extends('layouts.auth')

@section('page-title')
    {{ __('Login') }}
@endsection
@php

@endphp
@section('language-bar')
    <li class="nav-item bth-primary">
        <select name="language" id="language" class="btn btn-primary ms-2 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            @foreach( Utility::languages() as $language)
                <option @if($lang == $language) selected @endif value="{{ route('login',$language) }}">{{Str::upper($language)}}</option>
            @endforeach
        </select>
    </li>
@endsection


@section('content')

    <div class="card">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="card-body">
                    <div class="">
                        <h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
                    </div>
                    {{ Form::open(array('route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form form_data')) }}
                        <div class="">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')]) }}
                                @error('email')
                                    <span class="invalid-email text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password')]) }}
                                @error('password')
                                    <span class="invalid-password text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('password.request', $lang) }}" class=""><small>{{ __('Forgot your password?') }}</small></a>
                            </div>

                            @if (env('RECAPTCHA_MODULE') == 'yes')
                                <div class="form-group col-lg-12 col-md-12 mt-3">
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <span class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif

                            <div class="d-grid">
                                {{ Form::submit(__('Login'), ['class' => 'btn btn-primary btn-block mt-2', 'id' => 'saveBtn']) }}
                            </div>

                            @if (Utility::getValByName('signup_button') == 'on')
                                <p class="my-4 text-center">{{__('Don \'t have an account?')}}<a href="{{ route('register', $lang) }}" class="my-4 text-center text-primary"> {{ __('Register') }}</a></p>

                            @endif
                        </div>
                    {{ Form::close() }}

                </div>
            </div>
            <div class="col-xl-6 img-card-side">
                <div class="auth-img-content">
                    <img src="{{ asset('assets/images/auth/img-auth-3.svg') }}" alt="" class="img-fluid">
                    <h3 class="text-white mb-4 mt-5">{{__('Attention is the new currency')}}</h3>
                    <p class="text-white">{{__('The more effortless the writing looks, the more effort the writer
                        actually put into the process.')}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
<script src="{{asset('public/libs/jquery/dist/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(".form_data").submit(function(e) {
                $(".login_button").attr("disabled", true);
                return true;
            });
        });

    </script>
    @if (env('RECAPTCHA_MODULE') == 'yes')
        {!! NoCaptcha::renderJs() !!}
    @endif


@endpush
