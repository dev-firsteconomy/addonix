@extends('layouts.admin')
@section('page-title')
{{__('Lead')}}
@endsection
@section('title')

<style>

.radioForm button {
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

.radioForm.active  button {
    background: #2bdc52;
    color: #fff;
    border-color: #2bdc52;
}

.datatable .dropdown-toggle::after {
    display: none;
}

.table-data {
    margin: 0px 0px 10px;;
    border-collapse: collapse;
}
.table-data >* {
    border: 1px solid #ced4da;
    padding: 6px 15px;
    border-collapse: collapse;
}

.table-data dd {
    margin-bottom: 0;
}

.table-data dt {
    text-transform: capitalize;
}

.table-data dt span.h6 {
    font-size: 14px !important;
}

.viewData input {
    border: 0;
}

</style> 


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
        <div class="col-lg-5">
            <div class="input-group mb-3">
            <span class="input-group-text">From Date:</span>
            <input type="date" name="fromDate" class="form-control">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="input-group mb-3">
            <span class="input-group-text">To Date:</span>
            <input type="date" name="toDate" class="form-control">
            </div>
        </div>
        <input type="hidden" value="Lead" id="leadType" name="leadType">
        <!-- <div class="col-lg-4">
            <div class="input-group mb-3">
            <span class="input-group-text">Type:</span>
            <select class="form-select" aria-label="Default select example" name="leadType">
                <option value="">Select...</option>
                <option value="Lead" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Lead' ? 'selected' : ''}}>Lead</option>
                <option value="Opportunity" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Opportunity' ? 'selected' : ''}} >Opportunity</option>
                <option value="Active Customer" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Active Customer' ? 'selected' : ''}}>Active Customer</option>
                <option value="Non Active Customer" {{isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Non Active Customer' ? 'selected' : ''}}>Non Active Customer</option>
            </select>
            </div>
        </div> -->
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
<!-- radioForm -->
<div class="radioFormWrapper d-flex gap-4 mb-3">
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="lead" name="type" value="Lead">Leads</button>
    </form>
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="opportunity" name="type" value="Opportunity">Opportunity</button>
    </form>
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="active_customer" name="type" value="Active Customer">Active Customer</button>
    </form>
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="non_active_customer" name="type" value="Non Active Customer">Non Active Customer</button>
    </form>
</div>
<!-- radioForm -->
<div class="row">
    <div class="col-xl-12">
    @if (Session::has('success'))
    <div id="success-message" class="alert alert-success" role="alert" >
        {{ Session::get('success') }}
    </div>
    @endif
    @if (Session::has('error'))
    <div id="error-message" class="alert alert-error" role="alert" >
        {{ Session::get('error') }}
    </div>
    @endif
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{__('Company Name')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('Company Contact No.')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('Email')}}</th>
                                <th scope="col" class="sort" data-sort="completion">{{__('Lead Type')}}</th>
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
                                    <span class="budget">{{ ucfirst(@$lead->company_name)}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ @$lead->phone }}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(@$lead->email)}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(@$lead->type)}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->website) ? $lead->website:'-')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->industry_vertical) ? $lead->industry_vertical:'-')}}</span>
                                </td>

                                <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->assign_user_id) ? $lead->assign_user_id:'-')}}</span>
                                </td>

                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">...</a>
                                            <div class="dropdown-menu py-0">
                                                @can('Edit Lead')
                                                    <a href="{{ route('lead.edit',$lead->id) }}" class="dropdown-item">Edit</a>
                                                @endcan
                                                @can('Show Lead')
                                                    <a href="#" data-size="lg" data-url="{{ route('lead.show',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Lead Details')}}" class="dropdown-item">View</a>
                                                @endcan
                                                @if($lead->type == 'Lead' && $lead->industryProduct->isNotEmpty() && $lead->lead_interaction->isNotEmpty() && $lead->mail_sent == 0)
                                                <form method="POST" action="{{ route('leadApprovalMail') }}">
                                                    @csrf
                                                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                    <button type="submit" class="dropdown-item">Send Approval Email</button>
                                                </form>
                                                @endif
                                                <a href="#" data-size="lg" data-url="{{ route('addInteration',$lead->id) }}" data-ajax-popup="true" class="dropdown-item">Add Interaction</a>
                                                @if($lead->type == 'Opportunity' && $lead->industryProduct->isNotEmpty() && $lead->lead_interaction->isNotEmpty() && $lead->mail_sent == 1)
                                                    <a href="#" data-size="lg" data-url="{{ route('addQuotation',$lead->id) }}" class="dropdown-item" data-ajax-popup="true" data-title="{{__('Send Quotation')}}">Send Quotation</a>
                                                @endif
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]) !!}
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                {!! Form::close() !!}
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
    $(document).ready(function() {

        const currentUrl = window.location.href;

        // Check if the URL contains 'leadTab?type'
        if (currentUrl.includes('leadTab?type') || currentUrl.includes('leadSearch?')) {
            // Check if we have a stored value for "lastClickedButton"
            var lastClickedButton = localStorage.getItem('lastClickedButton') ? localStorage.getItem('lastClickedButton') : 'lead' ;
            var lastClickedType = localStorage.getItem('lastClickedType') ? localStorage.getItem('lastClickedType') : 'lead' ;
            
            if (lastClickedButton) {
                // If we do, add 'active' class to the button
                $('#' + lastClickedButton).parent().addClass('active');
            }

            if(lastClickedType){
                $('#leadType').val(lastClickedType);
            }
        }else{
            $('#lead').parent().addClass('active'); 
        }


        $(".tabBtn").click(function() {
            // When a button is clicked, remove 'active' class from all buttons
            $('.tabBtn').removeClass('active');
            
            // Add 'active' class to clicked button
            $(this).addClass('active');

            // Store the id of the clicked button
            localStorage.setItem('lastClickedButton', this.id);
            localStorage.setItem('lastClickedType', this.value);

            $('#leadType').val(this.value);

            // ... continue with your existing click handler code ...
        });

        
        // $(".radioForm").click(function(){
        //     $(this).addClass('active')
        //     $(this).siblings().removeClass('active')
        // })
    });


    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
        document.getElementById('error-message').style.display = 'none';
    }, 3000);

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