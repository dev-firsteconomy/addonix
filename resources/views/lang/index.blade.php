@extends('layouts.admin')
@push('css-page')
@endpush
@push('script-page')
@endpush
@section('page-title')
    {{__('Language')}}
@endsection
@section('title')
    {{__('Language')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Language')}}</li>
@endsection
@section('action-btn')
    <div class="action-btn ms-2">
        <a href="#" data-url="{{ route('create.language') }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create New Language')}}" title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip">
            <span class="btn-inner--icon"><i class="ti ti-plus"></i></span>
        </a>
    </div>
    
    @if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en'))
        <div class="action-btn ms-2">
            {!! Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang]]) !!}
                <a href="#!" class="btn btn-sm btn-danger btn-icon m-1 show_confirm" data-bs-toggle="tooltip" title='Delete'>
                    <i class="ti ti-trash"></i>
                </a>
            {!! Form::close() !!}
        </div>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column " id="myTab4" role="tablist">
                        @foreach($languages as $lang)
                            <li class="nav-item">
                                <a href="{{route('manage.language',[$lang])}}" class="nav-link {{($currantLang == $lang)?'active':''}}">{{Str::upper($lang)}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
                    <div class="p-3 card">
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill"
                        data-bs-target="#labels" type="button">{{ __('Labels')}}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill"
                        data-bs-target="#messages" type="button">{{ __('Messages')}}</button>
                </li>

            </ul>
        </div>
        <div class="card">
            <div class="card-body p-3">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="labels" role="tabpanel" aria-labelledby="home-tab">
                        <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                            @csrf
                            <div class="row">
                                @foreach($arrLabel as $label => $value)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="example3cols1Input">{{$label}} </label>
                                            <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                        </div>
                                    </div>
                                @endforeach
                                <div class="card-footer text-end">
                                    <input type="submit" value="{{__('Save Changes')}}" class="btn btn-primary">
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                            @csrf
                            <div class="row">
                                @foreach($arrMessage as $fileName => $fileValue)
                                    <div class="col-lg-12">
                                        <h5>{{ucfirst($fileName)}}</h5>
                                    </div>
                                    @foreach($fileValue as $label => $value)
                                        @if(is_array($value))
                                            @foreach($value as $label2 => $value2)
                                                @if(is_array($value2))
                                                    @foreach($value2 as $label3 => $value3)
                                                        @if(is_array($value3))
                                                            @foreach($value3 as $label4 => $value4)
                                                                @if(is_array($value4))
                                                                    @foreach($value4 as $label5 => $value5)
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" >{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" >{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" >{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" >{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" >{{$fileName}}.{{$label}}</label>
                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                            <div class="card-footer text-end">
                                <input type="submit" value="{{__('Save Changes')}}" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection






