@extends('layouts.admin')
@section('page-title')
    {{__('Lead Edit')}}
@endsection
@section('title')
        <div class="page-header-title">
           {{__('Edit Lead')}} {{ '('. $lead->company_name .')' }}
        </div>
@endsection
@section('action-btn')
    
    <div class="btn-group" role="group">
        @if(!empty($previous))
        <div class="action-btn  ms-2">
            <a href="{{ route('lead.edit',$previous) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        @else
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        @endif
        @if(!empty($next))
        <div class="action-btn  ms-2">
            <a href="{{ route('lead.edit',$next) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Next')}}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        @else
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Next')}}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        @endif
    </div>

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Lead')}}</a></li>
    <li class="breadcrumb-item">{{__('Details')}}</li>
@endsection
@section('content')


<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            
            <!-- <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Overview') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{__('Stream')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{__('Tasks')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div> -->
           
            <div class="col-xl-12">
                @if (Session::has('message'))
                <div id="success-message" class="alert alert-success" role="alert" >
                    {{ Session::get('message') }}
                </div>
                @endif
                <div id="useradd-1" class="card">
                    {{Form::model($lead,array('route' => array('lead.update', $lead->id), 'method' => 'PUT')) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{__('Edit About Your Lead Information')}}</small>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('company_name',__('comapny name'),['class'=>'form-label']) }}
                                        {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter comapny name'),'required'=>'required'))}}
                                        @error('company_name')
                                        <span class="invalid-company_name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('lead_type_id',__(' Type'),['class'=>'form-label']) }}

                                        <?php
                                        $typeOptions = [
                                            ''=>'Select Lead Type',
                                            'Lead' => 'Lead',
                                            'Opportunity' => 'Opportunity',
                                            'Active Customer' => 'Active Customer',
                                            'Non Active Customer' => 'Non Active Customer',
                                        ];
                                        ?>

                                        {!! Form::select('lead_type_id',$typeOptions, $lead->lead_type_id,array('class' => 'form-control')) !!}
                                        @error('lead_type_id')
                                        <span class="invalid-lead_type_id" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                        {{Form::text('company_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                        @error('company_email')
                                        <span class="invalid-company_email" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
                                        {{Form::text('company_mobile',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
                                        @error('company_mobile')
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
                                        {{Form::label('company_address',__('Lead Address'),['class'=>'form-label']) }}
                                        {{Form::text('company_address',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Address'),'required'=>'required'))}}
                                        @error('company_address')
                                        <span class="invalid-company_address" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                    {{ Form::label('industry', __('Industry'), ['class' => 'form-label']) }}
                                        <?php
                                        $industryOptions = [
                                            ''=>'Select industry Type',
                                            'industry 1' => 'industry 1',
                                            'industry 2' => 'industry 2',
                                        ];
                                        ?>
                                        {{ Form::select('industry_vertical', $industryOptions, $lead->industry_vertical, ['class' => 'form-control', 'required' => 'required']) }}

                                        @error('industry_vertical')
                                            <span class="invalid-industry_vertical" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                               
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('user',__(' Assigned User'),['class'=>'form-label']) }}

                                        @php 
                                        $userOptions = App\Models\User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
                                                    $userOptions->prepend('--', '');
                                        @endphp

                                        {!! Form::select('assign_user_id',$userOptions, $lead->assign_user_id,array('class' => 'form-control')) !!}
                                        @error('assign_user_id')
                                        <span class="invalid-assign_user_id" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Persons</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Name</p>
                                </th>
                                <th>
                                    <p class="mb-0">Designation</p>
                                </th>
                                <th>
                                    <p class="mb-0">Contact Number</p>
                                </th>
                                <th>
                                    <p class="mb-0">Email Id</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->industryPerson as $person)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i}}</th>
                                <td><input name="name[]" class="form-control" type="text" value="{{ $person->name }}"/></td>
                                <td><input name="designation[]" class="form-control" type="text" value="{{ $person->designation }}" /></td>
                                <td><input name="contact_number[]" class="form-control" type="tel"  value="{{ $person->contact_number }}"/></td>
                                <td><input name="email_id[]" class="form-control" type="email" value="{{ $person->email_id }}" /></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Product</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Product Name</p>
                                </th>
                                <th>
                                    <p class="mb-0">Serial Number</p>
                                </th>
                                <th>
                                    <p class="mb-0">Subscriptiion start date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Subscriptiion End date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Price</p>
                                </th>
                                <th>
                                    <p class="mb-0">Sale Date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Created by</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->industryProduct as $product)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td><input name="product_name[]" class="form-control" type="text" value="{{ $product->product_name }}"/></td>
                                <td><input name="serial_number[]" class="form-control" type="text" value="{{ $product->serial_number }}"/></td>
                                <td><input name="sub_start_date[]" class="form-control" type="date" value="{{ $product->sub_start_date }}" /></td>
                                <td><input name="sub_end_date[]" class="form-control" type="date" value="{{ $product->sub_end_date }}" /></td>
                                <td><input name="price[]" class="form-control" type="text" style="width:120px" value="{{ $product->price }}"/></td>
                                <td><input name="sale_date[]" class="form-control" type="date" value="{{ $product->sale_date }}" /></td>
                                <td><input name="created_by[]" class="form-control" type="text" value="{{ $product->created_by }}" /></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>interation</h5>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        {{Form::label('interaction_date',__('Interaction Date'),['class'=>'form-label']) }}
                        {{Form::date('interaction_date',null,array('class'=>'form-control','required'=>'required'))}}
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        {{Form::label('interaction_activity_type',__('Interaction Activity Type'),['class'=>'form-label']) }}
                        {{Form::select('interaction_activity_type',[''=>'Select Activities Type','Call'=>'Call','Meeting'=>'Meeting','Opportunity'=>'Opportunity','Demo'=>'Demo',
                            'Quotation'=>'Quotation','MOM'=>'MOM','PI'=>'PI'],null,array('class'=>'form-control','required'=>'required'))}}
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        {{Form::label('interaction_feedback',__('Interaction Feedback'),['class'=>'form-label']) }}
                        {{Form::text('interaction_feedback',null,array('class'=>'form-control','placeholder'=>__('Enter Feedback'),'required'=>'required'))}}
                    </div>
                </div>


                                
                                <div class="text-end">
                                    {{Form::submit(__('Update'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>


                            </div>
                        </form>
                    </div>
                    {{Form::close()}}
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
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000); // Hide the message after 5 seconds (adjust the timeout value as needed)
    </script>
@endpush
