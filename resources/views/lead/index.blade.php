@extends('layouts.admin')
@section('page-title')
{{__('Lead')}}
@endsection
@section('title')

<!-- <style>

.datatable .dropdown-toggle::after {
    display: none;
}

.radioForm input {
    padding: 6px 10px;
    display: inline-block;
    border: 1px solid grey;
    cursor: pointer;
    border-radius: 4px;
    min-width: 110px;
    height: 42px;
    box-sizing: border-box;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    text-transform: capitalize;
}

.radioForm  label {
    display: none;
}

.radioForm.active  input {
    background: #2bdc52;
    color: #fff;
    border-color: #2bdc52;
}

</style> -->
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
            <input type="date" name="fromDate" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group mb-3">
            <span class="input-group-text">To Date:</span>
            <input type="date" name="toDate" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group mb-3">
            <span class="input-group-text">Filter status Wise:</span>
            <select class="form-select" aria-label="Default select example" name="leadType">
                <option value="">Select...</option>
                <option value="Lead" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Lead' ? 'selected' : ''}}>Lead</option>
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
@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert" >
    {{ Session::get('message') }}
</div>
@endif
@if (Session::has('error'))
<div id="error-message" class="alert alert-error" role="alert" >
    {{ Session::get('message') }}
</div>
@endif
<!-- radioForm -->
<!-- <div class="radioFormWrapper d-flex gap-2">
    <form action="LeadTab" class="radioForm active" method="get">
        <input type="text" id="lead" name="type" value="Lead" readonly checked />
        <label for="lead">Leads</label>
    </form>
    <form action="LeadTab" class="radioForm" method="get">
        <input type="text" id="opportunity" name="type" value="Opportunity" readonly />
        <label for="opportunity">Opportunities</label>
    </form>
    <form action="LeadTab" class="radioForm" method="get">
        <input type="text" id="active_customer" name="type" value="Active Customer" readonly />
        <label for="active_customer">Active Customers</label>
    </form>
    <form action="LeadTab" class="radioForm" method="get">
        <input type="text" id="non_active_customer" name="type" value="Non Active Customer" readonly />
        <label for="non_active_customer">Dead Leads</label>
    </form>
</div> -->
<!-- radioForm -->
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
                                    <span class="budget">{{ ucfirst(!empty($lead->type) ? $lead->type:'--')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ !empty($lead->phone) ? $lead->phone:'--' }}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->email) ? $lead->email:'--')}}</span>
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
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">...</a>
                                            <div class="dropdown-menu py-0">
                                                @can('Edit Lead')
                                                    <a href="{{ route('lead.edit',$lead->id) }}" class="dropdown-item" data-bs-toggle="tooltip" title='Edit Lead Details'>Edit</a>
                                                @endcan
                                                @can('Show Lead')
                                                    <a href="#" data-size="lg" data-url="{{ route('lead.show',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Lead Details')}}" class="dropdown-item" data-bs-toggle="tooltip" title='View Lead Details'>View</a>
                                                @endcan
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]) !!}
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                {!! Form::close() !!}
                                                @if(!empty($lead->industryProduct) && !empty($lead->lead_interaction) && $lead->mail_sent == 0)
                                                <form method="POST" action="{{ route('leadApprovalMail') }}">
                                                    @csrf
                                                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                    <button type="submit" class="dropdown-item">Send Approval Email</button>
                                                </form>
                                                @endif
                                                <a href="#" data-size="lg" data-url="{{ route('addInteration',$lead->id) }}" class="dropdown-item" data-bs-toggle="tooltip" title='Add New Interaction' data-ajax-popup="true" data-title="{{__('Add Interation')}}">Add Interaction</a>
                                                <a href="#" data-size="lg" data-url="{{ route('addQuotation',$lead->id) }}" class="dropdown-item" data-bs-toggle="tooltip" title='Send Quotation' data-ajax-popup="true" data-title="{{__('Send Quotation')}}">Send Quotation</a>
                                            </div>
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
    </div>
</div>

@endsection

@push('script-page')
<script>
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
        document.getElementById('error-message').style.display = 'none';
    }, 3000);


    // $(".radioForm").click(function(){
    //     $(this).addClass('active')
    //     $(this).siblings().removeClass('active')
    // })

    // $('#lead').click(function(){
    //     $('#leadType').val('Lead');
    // })

    // $('#opportunity').click(function(){
    //     $('#leadType').val('Opportunity');
    // })

    // $('#active_customer').click(function(){
    //     $('#leadType').val('Active Customer');
    // })

    // $('#non_active_customer').click(function(){
    //     $('#leadType').val('Non Active Customer');
    // })

    $(document).ready(function() {
        $(document).on('change','#product-select',function() {
            var productId = $(this).val();
            if (productId !== '') {
                // Make an AJAX request to fetch the product price
                $.ajax({
                    url: '/get-product-price',
                    type: 'GET',
                    data: { productId: productId },
                    success: function(response) {
                        // Update the price input with the fetched price
                        $('#price-input').val(response.price);
                    },
                    error: function() {
                        // Handle error if the AJAX request fails
                        console.log('Error occurred while fetching the product price.');
                    }
                });
            } else {
                // Clear the price input if no product is selected
                $('#price-input').val('');
            }
        });

        $(document).on('change','#discount-input',function() {
            var price = parseFloat($('#price-input').val());
            var discount = parseFloat($(this).val());
            if (!isNaN(price) && !isNaN(discount)) {
                var finalAmount = price - (price * discount / 100);
                $('#final-amount').val(finalAmount.toFixed(2));
            } else {
                $('#final-amount').val('');
            }
        });
    });
</script>

</script>
@endpush