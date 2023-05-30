@extends('layouts.admin')
@section('page-title')
{{__('Lead')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Lead')}}
</div>

@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item">{{__('Lead')}}</li>
@endsection
@section('action-btn')
<!-- <a href="{{ route('lead.grid') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{ __('Kanban View') }}">
    <i class="ti ti-layout-kanban"></i>
</a> -->

@can('Create Lead')
<a href="#" data-url="{{ route('lead.create',['lead',0]) }}" data-size="lg" data-ajax-popup="true"
    data-bs-toggle="tooltip" data-title="{{__('Create New Lead')}}" title="{{__('Create')}}"
    class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
@endcan
@endsection

@section('filter')
@endsection


@section('content')

<form action="leadSearch" method="get">
<div class="row">
        <div class="col-lg-3">
            <div class="input-group mb-3">
            <span class="input-group-text">From Date:</span>
            <input type="date" name="fromDate" class="form-control" value="<?php echo isset($_REQUEST['fromDate']) ? $_REQUEST['fromDate'] : ''; ?>" >
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group mb-3">
            <span class="input-group-text">To Date:</span>
            <input type="date" name="toDate" class="form-control" value="<?php echo isset($_REQUEST['toDate']) ? $_REQUEST['toDate'] : ''; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group mb-3">
            <span class="input-group-text">Filter status Wise:</span>
            <select class="form-select" aria-label="Default select example" name="leadType">
                <option value="">Select...</option>
                <option value="lead" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'lead' ? 'selected' : ''}}>lead</option>
                <option value="Opportunity" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Opportunity' ? 'selected' : ''}} >Opportunity</option>
                <option value="Active Customer" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Active Customer' ? 'selected' : ''}}>Active Customer</option>
                <option value="Non Active Customer" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Non Active Customer' ? 'selected' : ''}}>Non Active Customer</option>
            </select>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="input-group mb-3">  
                <button class="btn btn-primary" type="submit" id="leadSearchBtn">Search!</button>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="input-group mb-3">  
                <a href="/lead" class="btn btn-primary">Reset</a>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{__('Company Name')}}</th>
                                <th scope="col" class="sort" data-sort="completion">{{__('Lead Type')}}</th>
                                <!-- <th scope="col" class="sort" data-sort="budget">{{__('Company Address')}}</th> -->
                                <th scope="col" class="sort" data-sort="status">{{__('Company Contact No.')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('Email')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('Website')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('Industry Vertical')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('Lead Owner')}}</th>
                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                <th scope="col" class="text-start
                                ">{{__('Action')}}</th>
                                @endif
                            </tr>
                        </thead>
      
                        <tbody>
                            @foreach($leads as $lead)
                            <tr>
                                <!-- <td>
                                    <a href="#" data-size="md" data-url="{{ route('lead.show',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Lead Details')}}" class="action-item text-primary">
                                        {{ ucfirst($lead->name) }}
                                    </a>
                                </td> -->
                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->company_name) ? $lead->company_name:'--')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->lead_type_id) ? $lead->lead_type_id:'--')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ !empty($lead->company_mobile) ? $lead->company_mobile:'--' }}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->company_email) ? $lead->company_email:'--')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->website) ? $lead->website:'--')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->industry_vertical) ? $lead->industry_vertical:'--')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->assign_user_id) ? $lead->assign_user_id:'--')}}</span>
                                </td>

                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                    <td class="text-end">
                                        <div class="action-btn bg-dark ms-2">
                                            <a href="#" data-size="lg" data-url="{{ route('addInteration',$lead->id) }}" data-bs-toggle="tooltip" title="{{__('interation')}}" data-ajax-popup="true" data-title="{{__('add Interation')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-dark ms-2">
                                            <a href="#" data-size="lg" data-url="{{ route('changeStatus',$lead->id) }}" data-bs-toggle="tooltip" title="{{__('Change Status')}}" data-ajax-popup="true" data-title="{{__('change status')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="#" data-size="lg" data-url="{{ route('lead.show',$lead->id) }}" data-bs-toggle="tooltip" title="{{__('Details')}}" data-ajax-popup="true" data-title="{{__('Lead Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Edit Lead')
                                        <div class="action-btn bg-info ms-2">
                                            <a href="{{ route('lead.edit',$lead->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip"title="{{__('Edit')}}" data-title="{{__('Edit Lead')}}"><i class="ti ti-edit"></i></a>
                                        </div>
                                        @endcan
                                        @can('Delete Lead')
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]) !!}
                                        <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                            <i class="ti ti-trash"></i>
                                        </a>
                                        {!! Form::close() !!}
                                    </div>
                                        
                                            {{-- <a href="#" class="btn  btn-icon btn-danger px-1  " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').' | '.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$lead->id}}').submit();">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id],'id'=>'delete-form-'.$lead ->id]) !!}
                                        {!! Form::close() !!} --}}
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

@endsection


