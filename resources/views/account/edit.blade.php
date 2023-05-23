@extends('layouts.admin')
@section('page-title')
    {{__('Account Edit')}}
@endsection
@section('title')
        <div class="page-header-title">
            <h4 class="m-b-10">{{__('Edit Account')}} {{ '('. $account->name .')' }}</h4>
        </div>
@endsection
@section('action-btn')
    <div class="btn-group" role="group">
        @if(!empty($previous))
            <div class="action-btn  ms-2">
                <a href="{{ route('account.edit',$previous) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        @else
            <div class="action-btn ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        @endif
        @if(!empty($next))
            <div class="action-btn ms-2">
                <a href="{{ route('account.edit',$next) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Next')}}">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        @else
            <div class="action-btn ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Next')}}">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        @endif
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('account.index')}}">{{__('Account')}}</a></li>
    <li class="breadcrumb-item">{{__('Edit')}}</li>
@endsection
@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Overview') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{__('Stream')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{__('Contacts')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-4" class="list-group-item list-group-item-action border-0">{{__('Opportunities')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-5" class="list-group-item list-group-item-action border-0">{{__('Cases')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-6" class="list-group-item list-group-item-action border-0">{{__('Documents')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-7" class="list-group-item list-group-item-action border-0">{{__('Tasks')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div id="useradd-1" class="card">
                    {{Form::model($account,array('route' => array('account.update', $account->id), 'method' => 'PUT')) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{__('Edit details about your account information')}}</small>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                        @error('name')
                                        <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                        {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter email'),'required'=>'required'))}}
                                        @error('email')
                                        <span class="invalid-email" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
                                        {{Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter phone'),'required'=>'required'))}}
                                        @error('phone')
                                        <span class="invalid-phone" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('website',__('Website'),['class'=>'form-label']) }}
                                        {{Form::text('website',null,array('class'=>'form-control','placeholder'=>__('Enter Website'),'required'=>'required'))}}
                                        @error('website')
                                        <span class="invalid-website" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('billing_address',__('Billing Address')),['class'=>'form-label'] }}
                                         <div class="action-btn bg-primary ms-2 float-end">
                                        <a class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" id="billing_data" data-bs-toggle="tooltip" data-placement="top" title="Same As Billing Address"><i class="ti ti-copy"></i></a>
                                        </div>
                                        <span class="clearfix"></span>
                                        {{Form::text('billing_address',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Address'),'required'=>'required'))}}
                                        @error('billing_address')
                                        <span class="invalid-billing_address" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('shipping_address',__('Shipping Address'),['class'=>'form-label']) }}
                                        {{Form::text('shipping_address',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping Address'),'required'=>'required'))}}
                                        @error('shipping_address')
                                        <span class="invalid-shipping_address" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('city',__('City'),['class'=>'form-label']) }}
                                        {{Form::text('billing_city',null,array('class'=>'form-control','placeholder'=>__('Enter Billing City'),'required'=>'required'))}}
                                        @error('billing_city')
                                        <span class="invalid-billing_city" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('state',__('State'),['class'=>'form-label']) }}
                                        {{Form::text('billing_state',null,array('class'=>'form-control','placeholder'=>__('Enter Billing State'),'required'=>'required'))}}
                                        @error('billing_state')
                                        <span class="invalid-billing_state" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('city',__('City'),['class'=>'form-label']) }}
                                        {{Form::text('shipping_city',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping City'),'required'=>'required'))}}
                                        @error('shipping_city')
                                        <span class="invalid-shipping_city" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('state',__('State'),['class'=>'form-label']) }}
                                        {{Form::text('shipping_state',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping State'),'required'=>'required'))}}
                                        @error('shipping_state')
                                        <span class="invalid-shipping_state" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('billing_country',__('Country'),['class'=>'form-label']) }}
                                        {{Form::text('billing_country',null,array('class'=>'form-control','placeholder'=>__('Enter Billing country'),'required'=>'required'))}}
                                        @error('billing_country')
                                        <span class="invalid-billing_country" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('billing_country',__('Postal Code'),['class'=>'form-label']) }}
                                        {{Form::number('billing_postalcode',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Postal Code'),'required'=>'required'))}}
                                        @error('billing_postalcode')

                                        <span class="invalid-billing_postalcode" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('billing_country',__('Country'),['class'=>'form-label']) }}
                                        {{Form::text('shipping_country',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping Country'),'required'=>'required'))}}
                                        @error('shipping_country')
                                        <span class="invalid-shipping_country" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        {{Form::label('shipping_postalcode',__('Postal Code'),['class'=>'form-label']) }}
                                        {{Form::number('shipping_postalcode',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping Postal Code'),'required'=>'required'))}}
                                        @error('shipping_postalcode')
                                        <span class="invalid-shipping_postalcode" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="mt-1 mb-2">
                                    <h6>{{__('Detail')}}</h6>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('type',__('Type'),['class'=>'form-label']) }}
                                        {!! Form::select('type', $accountype, null,array('class' => 'form-control ','required'=>'required')) !!}
                                        @error('type')
                                        <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('industry',__('Industry'),['class'=>'form-label']) }}
                                        {!! Form::select('industry', $industry, null,array('class' => 'form-control ','required'=>'required')) !!}
                                        @error('industry')
                                        <span class="invalid-industry" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('document_id',__('Document')) }}
                                        {!! Form::select('document_id', $document_id, null,array('class' => 'form-control')) !!}
                                        @error('industry')
                                        <span class="invalid-industry" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {{Form::label('description',__('Description'),['class'=>'form-label']) }}
                                        {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                    {{Form::label('user',__('Assigned User'),['class'=>'form-label']) }}
                                    {!! Form::select('user', $user, $account->user_id,array('class' => 'form-control ')) !!}
                                    @error('user')
                                    <span class="invalid-user" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    {{Form::submit(__('Save'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>


                            </div>
                        </form>
                    </div>
                    {{Form::close()}}
                </div>

                <div id="useradd-2" class="card">
                    {{Form::open(array('route' => array('streamstore',['account',$account->name,$account->id]), 'method' => 'post','enctype'=>'multipart/form-data')) }}
                    <div class="card-header">
                        <h5>{{__('Stream')}}</h5>
                        <small class="text-muted">{{__('Add stream comment')}}</small>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        {{Form::label('stream',__('Stream'),['class'=>'form-label']) }}
                                        {{Form::text('stream_comment',null,array('class'=>'form-control','placeholder'=>__('Enter Stream Comment'),'required'=>'required'))}}
                                    </div>
                                </div>
                                <input type="hidden" name="log_type" value="account comment">
                                <div class="col-12 mb-3 field" data-name="attachments">
                                    <div class="attachment-upload">
                                        <div class="attachment-button">
                                            <div class="pull-left">
                                                <div class="form-group">
                                                {{Form::label('attachment',__('Attachment'),['class'=>'form-label']) }}
                                                {{-- {{Form::file('attachment',array('class'=>'form-control'))}} --}}
                                                <input type="file"name="attachment" class="form-control mb-3" onchange="document.getElementById('attachment').src = window.URL.createObjectURL(this.files[0])">
                                                <img id="attachment" width="20%" height="20%" />


                                                </div>
                                            </div>
                                        </div>
                                        <div class="attachments"></div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    {{Form::submit(__('Save'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12">
                        <div class="card-header">
                            <h5>{{__('Latest comments')}}</h5>
                        </div>
                        @foreach($streams as $stream)

                            @php
                                $remark = json_decode($stream->remark);
                            @endphp
                            @if($remark->data_id == $account->id)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <ul class="list-group team-msg">
                                                <li class="list-group-item border-0 d-flex align-items-start mb-2">
                                                    <div class="avatar me-3">
                                                        @php
                                                            $profile=\App\Models\Utility::get_file('upload/profile/');
                                                        @endphp
                                                        <a href="{{(!empty($stream->file_upload))? ($profile.$stream->file_upload): $profile.'avatar.png'}}" target="_blank">
                                                            <img alt="" class="rounded-circle" @if(!empty($stream->file_upload)) src="{{(!empty($stream->file_upload))? ($profile.$stream->file_upload): $profile.'avatar.png'}}" @else  avatar="{{$remark->user_name}}" @endif>
                                                        </a>

                                                    </div>
                                                    <div class="d-block d-sm-flex align-items-center right-side">
                                                        <div class="d-flex align-items-start flex-column justify-content-center mb-3 mb-sm-0">
                                                            <div class="h6 mb-1">{{$remark->user_name}}
                                                            </div>
                                                            <span class="text-sm lh-140 mb-0">
                                                                posted to <a href="#">{{$remark->title}}</a> , {{$stream->log_type}}  <a href="#">{{$remark->stream_comment}}</a>
                                                            </span>
                                                        </div>
                                                        <div class=" ms-2  d-flex align-items-center ">
                                                            <small class="float-end ">{{$stream->created_at}}</small>
                                                        </div>
                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>


                    {{ Form::close() }}
                </div>



                <div id="useradd-3" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Contacts') }}</h5>
                                <small class="text-muted">{{__('Assigned contacts for this account')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('contact.create',['account',$account->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip"title="{{__('Create')}}" data-title="{{__('Create New Contact')}}" class="btn btn-sm btn-primary ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{__('Email')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Phone')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('City')}}</th>
                                        @if(Gate::check('Show Contact') || Gate::check('Edit Contact') || Gate::check('Delete Contact'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('contact.show',$contact->id) }}" data-ajax-popup="true"  data-title="{{__('Contact Details')}}" class="action-item text-primary">
                                                    {{ $contact->name }}
                                                </a>
                                            </td>
                                            <td class="budget">
                                                {{ $contact->email }}
                                            </td>
                                            <td>
                                                <span class="budget">
                                                    {{ $contact->phone }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="budget">{{ $contact->contact_city }}</span>
                                            </td>
                                            @if(Gate::check('Show Contact') || Gate::check('Edit Contact') || Gate::check('Delete Contact'))
                                                <td class="text-end">

                                                        @can('Show Contact')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md" data-url="{{ route('contact.show',$contact->id) }}" data-bs-toggle="tooltip" title="{{__('Details')}}" data-ajax-popup="true" data-title="{{__('Contact Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Contact')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('contact.edit',$contact->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Contact Edit')}}"><i class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Contact')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['contact.destroy', $contact->id]]) !!}
                                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                            </div>

                                                        @endcan

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div id="useradd-4" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Opportunities') }}</h5>
                                <small class="text-muted">{{__('Assigned Opportunities for this account')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('opportunities.create',['account',$account->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Opportunities')}}" class="btn btn-sm btn-primary btn-icon-only ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive ">
                            <table  class="table datatable" id="datatable1">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Opportunities Stage')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Amount')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Assigned User')}}</th>
                                        @if(Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($opportunitiess as $opportunities)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('opportunities.show', $opportunities->id) }}" data-ajax-popup="true" data-title="{{__('Opportunities Details')}}" class="action-item text-primary">
                                                    {{ $opportunities->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-success p-2 px-3 rounded">{{  !empty($opportunities->stages)?$opportunities->stages->name:'-' }}</span>
                                            </td>

                                            <td>
                                                <span class="budget">{{\Auth::user()->priceFormat($opportunities->amount)}}</span>
                                            </td>
                                            <td>
                                                <span class="budget">{{  !empty($opportunities->assign_user)?$opportunities->assign_user->name:'-' }}</span>
                                            </td>
                                            @if(Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities'))
                                                <td class="text-end">

                                                        @can('Show Opportunities')
                                                        <div class="action-btn bg-warning ms-2">
                                                        <a href="#" data-size="md" data-url="{{ route('opportunities.show', $opportunities->id) }}" data-bs-toggle="tooltip"  data-ajax-popup="true" data-title="{{__('Opportunities Details')}}" title="{{__(' details')}}"class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                        </div>
                                                        @endcan
                                                        @can('Edit Opportunities')
                                                        <div class="action-btn bg-info ms-2">
                                                        <a href="{{ route('opportunities.edit',$opportunities->id) }}" data-bs-toggle="tooltip"  class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-title="{{__('Opportunities Edit')}}"title="{{__(' Edit')}}"><i class="ti ti-edit"></i></a>
                                                        </div>
                                                        @endcan
                                                        @can('Delete Opportunities')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['opportunities.destroy', $opportunities->id]]) !!}
                                                        <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        {!! Form::close() !!}


                                                        @endcan
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div id="useradd-5" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Cases') }}</h5>
                                <small class="text-muted">{{__('Assigned Cases for this account')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('commoncases.create',['account',$account->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Common Case')}}" class="btn btn-sm btn-primary btn-icon-only ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable2">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{__('Number')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Status')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Priority')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Created At')}}</th>
                                        @if(Gate::check('Show CommonCase') || Gate::check('Edit CommonCase') || Gate::check('Delete CommonCase'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cases as $case)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('commoncases.show',$case->id) }}" data-ajax-popup="true" data-title="{{__('Cases Details')}}" class="action-item text-primary">
                                                    {{ $case->name }}
                                                </a>
                                            </td>
                                            <td class="budget">
                                                {{ $case->number }}
                                            </td>
                                            <td>
                                                @if($case->status == 0)
                                                    <span class="badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                @elseif($case->status == 1)
                                                    <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                @elseif($case->status == 2)
                                                    <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                @elseif($case->status == 3)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                @elseif($case->status == 4)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                @elseif($case->status == 5)
                                                    <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($case->priority == 0)
                                                    <span class="badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                @elseif($case->priority == 1)
                                                    <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                @elseif($case->priority == 2)
                                                    <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                @elseif($case->priority == 3)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="budget">{{\Auth::user()->dateFormat($case->created_at)}}</span>
                                            </td>
                                            @if(Gate::check('Show CommonCase') || Gate::check('Edit CommonCase') || Gate::check('Delete CommonCase'))
                                            <td class="text-end">

                                                    @can('Show CommonCase')
                                                    <div class="action-btn bg-warning ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('commoncases.show',$case->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Cases Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    </div>
                                                    @endcan
                                                    @can('Edit CommonCase')
                                                    <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('commoncases.edit',$case->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Cases Edit')}}"><i class="ti ti-edit"></i></a>
                                                    </div>
                                                    @endcan
                                                    @can('Delete CommonCase')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['commoncases.destroy', $case->id]]) !!}
                                                       <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                           <i class="ti ti-trash"></i>
                                                       </a>
                                                       {!! Form::close() !!}
                                                   </div>
                                                    @endcan

                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div id="useradd-6" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Documents') }}</h5>
                        <small class="text-muted">{{__('Assigned Documents for this account')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('document.create',['account',$account->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Documents')}}" class="btn btn-sm btn-primary btn-icon-only">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable3">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{__('File')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Status')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Created At')}}</th>
                                        @if(Gate::check('Show Document') || Gate::check('Edit Document') || Gate::check('Delete Document'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('document.show',$document->id) }}" data-ajax-popup="true" data-title="{{__('Document Details')}}" class="action-item text-primary">
                                                    {{ $document->name }}</a>
                                            </td>
                                            <td class="budget">
                                                @if(!empty($document->attachment))
                                                @php
                                                $profile=\App\Models\Utility::get_file('upload/profile/');
                                            @endphp
                                            <a href="{{ $profile.'/'.$document->attachment }}" download=""><i class="ti ti-download"></i></a>
                                                @else
                                                    <span>
                                                        {{ __('No File') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($document->status == 0)
                                                    <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @elseif($document->status == 1)
                                                    <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @elseif($document->status == 2)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @elseif($document->status == 3)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="budget">{{\Auth::user()->dateFormat($document->created_at)}}</span>
                                            </td>
                                            @if(Gate::check('Show Document') || Gate::check('Edit Document') || Gate::check('Delete Document'))
                                            <td class="text-end">

                                                    @can('Show Document')
                                                    <div class="action-btn bg-warning ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('document.show',$document->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Document Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    </div>
                                                    @endcan
                                                    @can('Edit Document')
                                                    <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('document.edit',$document->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Document Edit')}}"><i class="ti ti-edit"></i></a>
                                                    </div>
                                                    @endcan
                                                    @can('Delete Document')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $document->id]]) !!}
                                                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan

                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div id="useradd-7" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Tasks') }}</h5>
                                 <small class="text-muted">{{__('Assigned Tasks for this account')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('task.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Task')}}" title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon-only ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable4">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{__('Parent')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Stage')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Date Start')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Assigned User')}}</th>
                                        @if(Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('task.show',$task->id) }}" data-ajax-popup="true" data-title="{{__('Task Details')}}" class="action-item text-primary">
                                                    {{ $task->name }}
                                                </a>
                                            </td>
                                            <td class="budget">
                                               {{ $task->parent }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success p-2 px-3 rounded">{{  !empty($task->stages)?$task->stages->name:'' }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success p-2 px-3 rounded">{{\Auth::user()->dateFormat($task->start_date)}}</span>
                                            </td>
                                            <td>
                                                <span class="budget">{{  !empty($task->assign_user)?$task->assign_user->name:'-' }}</span>
                                            </td>
                                            @if(Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                            <td class="text-end">

                                                    @can('Show Task')
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" data-size="md" data-url="{{ route('task.show',$task->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Task Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('Edit Task')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('task.edit',$task->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Task')}}"><i class="ti ti-edit"></i></a>
                                                        </div>
                                                    @endcan
                                                    @can('Delete Task')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['task.destroy', $task->id]]) !!}
                                                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan

                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>








@endsection
@push('script-page')

<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
    <script>

        $(document).on('change', 'select[name=parent]', function () {
            console.log('click');
            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            console.log('getparent', bid);
            $.ajax({
                url: '{{route('task.getparent')}}',
                type: 'POST',
                data: {
                    "parent": bid, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log('get data');
                    console.log(data);
                    $('#parent_id').empty();
                    {{--$('#parent_id').append('<option value="">{{__('Select Parent')}}</option>');--}}

                    $.each(data, function (key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>
@endpush
@push('script-page')
    <script>
        $(document).on('click', '#billing_data', function () {
            console.log('hi');
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>

@endpush
