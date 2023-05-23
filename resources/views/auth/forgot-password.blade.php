@extends('layouts.auth')

@section('page-title')
    {{ __('Reset Password') }}
@endsection


@section('language-bar')
    <li class="nav-item bth-primary">
        <select name="language" id="language" class="btn btn-primary ms-2 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            @foreach( Utility::languages() as $language)
                <option @if($lang == $language) selected @endif value="{{ route('password.request',$language) }}">{{Str::upper($language)}}</option>
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
                        <h2 class="mb-3 f-w-600">{{ __('Reset Password ') }}</h2>
                    </div>
                    @if (session('status'))
                        <small class="text-muted">{{ session('status') }}</small>
                    @endif
                    {{ Form::open(['route' => 'password.email', 'method' => 'post', 'id' => 'loginForm']) }}
                        <div class="">
                            <div class="form-group mb-3">
                                {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')]) }}
                                @error('email')
                                    <span class="invalid-email text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid">
                                {{ Form::submit(__('Forgot Password'), ['class' => 'btn btn-primary btn-block mt-2', 'id' => 'saveBtn']) }}
                            </div>
                            <p class="my-4 text-center">{{ __('Back to?') }} <a href="{{ url('login', $lang) }}" class="my-4 text-center text-primary">{{ __('Login') }}</a></p>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="col-xl-6 img-card-side">
                <div class="auth-img-content">
                    <img src="{{ asset('assets/images/auth/img-auth-3.svg') }}" alt="" class="img-fluid">
                    <h3 class="text-white mb-4 mt-5">“Attention is the new currency”</h3>
                    <p class="text-white">The more effortless the writing looks, the more effort the writer actually put
                        into the process.</p>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('custom-scripts')
    @if (env('RECAPTCHA_MODULE') == 'yes')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
