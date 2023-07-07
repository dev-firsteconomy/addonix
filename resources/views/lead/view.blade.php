@extends('layouts.admin')

@section('title')
<div class="page-header-title">
    {{__('View Lead')}}
</div>
@endsection
<style>
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
.btn-center{
    display: flex;
    align-items: center;
    justify-content: center;
}

.table-responsive .dropdown-toggle::after {
    display: none;
}
.viewDropdown{
    width: 40px; 
    display: inline-block; 
    margin:10px;
}
</style>
@section('action-btn')
<div class="btn-group" role="group">
    <div class="action-btn  ms-2">
        <a href="{{ route('lead.index') }}" class="btn btn-sm btn-primary btn-icon m-1">
            Back
        </a>
    </div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Lead')}}</a></li>
<li class="breadcrumb-item">{{__('View Lead')}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <dl class="row table-data">
                <div class="d-none">
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('source')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->source }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Parent Company Name')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->parent_company_name }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Company Name')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->company_name }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Company Address')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->lead_address }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Contact No.')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->phone }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Email')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->email }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Website')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->website }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Is Existing User')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->existing_customer }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Type')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->type }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('CBI’s identified')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->cbi_identified }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Met Or Spoke to Person')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->met_or_spoke }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('If an MNC')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->is_mnc }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Industry Vertical')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->industry_vertical }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Sales Stage')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->sales_stage }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Creation Date')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->create_date }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Estimated Closed Date')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->estimated_close_date }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Assign User')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ @$lead->assign_user_id }}</span></dd>
                </div>

                <div class="table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <p class="mb-0">#</p>
                                </th>
                                <th scope="col">
                                    <p class="mb-0">{{__('source')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Parent Company Name')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Company Name')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Company Address')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Contact No.')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Email')}}</p>
                                </th>
                                
                                <th>
                                    <p class="mb-0">{{__('Website')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Is Existing User')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Type')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('CBI’s identified')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Met Or Spoke to Person')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('If an MNC')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Industry Vertical')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Sales Stage')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Creation Date')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Estimated Closed Date')}}</p>
                                </th>
                                <th>
                                    <p class="mb-0">{{__('Assign User')}}</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td>{{ $lead->source }}</td>
                            <td>{{ $lead->parent_company_name }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->lead_address }}</td>
                            <td>{{ $lead->phone }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->website }}</td>
                            <td>{{ $lead->existing_customer }}</td>
                            <td>{{ $lead->type }}</td>
                            <td>{{ $lead->cbi_identified }}</td>
                            <td>{{ $lead->met_or_spoke }}</td>
                            <td>{{ $lead->is_mnc }}</td>
                            <td>{{ $lead->industry_vertical }}</td>
                            <td>{{ $lead->sales_stage }}</td>
                            <td>{{ $lead->create_date }}</td>
                            <td>{{ $lead->estimated_close_date }}</td>
                            <td>{{ @$lead->assign_user_id }}</td>
                        </tbody>
                    </table>
                </div>
            </dl>

            <div class="btn-center">
                <div class="action-btn bg-info ms-2">
                    <a href="{{ route('lead.edit', $lead->id) }}"
                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                        data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                        data-title="{{ __('Edit Product') }}">
                        <i class="ti ti-edit"></i>
                    </a>
                </div>
            </div>
            
            <dl class="row viewData">
                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Point of Contacts</h5>
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
                                <th>
                                    <p class="mb-0">Action</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->industryPerson as $person)
                            <tr>
                                <td scope="col">{{ $i}}</td>
                                <td class="text-capitalize">{{ $person->name }}</td>
                                <td class="text-capitalize">{{ $person->designation }}</td>
                                <td>{{ $person->contact_number }}</td>
                                <td>{{ $person->email_id }}</td>
                                <td>
                                    <div>
                                    @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('lead.show', $lead->id) }}" data-size="md" data-title="{{ __('Lead Details') }}"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('Edit Lead')
                                        <div class="action-btn bg-info ms-2">
                                            <a href="javascript:void(0)" data-url="{{ route('editPoc', $person->id) }}" data-ajax-popup="true"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                data-title="{{ __('Edit Point of Contact') }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                    @endcan
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="btn-center">
                    <a href="javascript:void(0)" data-url="{{ route('addPoc',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="Create New Point of Contact" title="" class="btn btn-sm btn-primary btn-icon m-1" data-bs-original-title="Create">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Opportunities</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Date Created</p>
                                </th>
                                <th>
                                    <p class="mb-0">Point Of Contact</p>
                                </th>
                                <th>
                                    <p class="mb-0">Product Type</p>
                                </th>
                                <th>
                                    <p class="mb-0">Stage</p>
                                </th>
                                <th>
                                    <p class="mb-0">Status</p>
                                </th>
                                <th>
                                    <p class="mb-0">Action</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->leadOpportunities as $opportunity)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td>{{ @$opportunity->date_created }}</td>
                                <td>{{ @$opportunity->poc->name }}</td>
                                <td>{{ @$opportunity->product_type }}</td>
                                <td>{{ @$opportunity->sales_stage }}</td>
                                <td>{{ @$opportunity->status }}</td>
                                <td>
                                    <div>
                                        @can('Show Lead')
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('lead.show', $lead->id) }}" data-size="md" data-title="{{ __('Lead Details') }}"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('Edit Lead')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="javascript:void(0)" data-url="{{ route('editOpportunityModal', $opportunity->id) }}" data-ajax-popup="true"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                    data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                    data-title="{{ __('Edit Point of Contact') }}">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('Edit Lead')
                                            <div class="dropdown viewDropDown">
                                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">...</a>
                                                <div class="dropdown-menu py-0">
                                                    <a href="javascript:void(0)" data-size="lg" data-url="{{ route('approvalEmailModal',$opportunity->id) }}" data-ajax-popup="true" class="dropdown-item">Send Email</a>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="btn-center">
                    <a href="javascript:void(0)" data-url="{{ route('createOpportunityModal',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="Create New Opportunity" title="" class="btn btn-sm btn-primary btn-icon m-1" data-bs-original-title="Create">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Interaction History</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Interaction Date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Interaction Type</p>
                                </th>
                                <th>
                                    <p class="mb-0">Interaction Feedback</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->lead_interaction as $interaction)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td>{{ @$interaction->interaction_date }}</td>
                                <td>{{ @$interaction->interaction_activity_type }}</td>
                                <td>{{ @$interaction->interaction_feedback }}</td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Quotation History</h5>
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
                                    <p class="mb-0">Price</p>
                                </th>
                                <th>
                                    <p class="mb-0">Discount</p>
                                </th>
                                <th>
                                    <p class="mb-0">Final Amount</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->leadQuotation as $quotation)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td>{{ @$quotation->product->name }}</td>
                                <td>{{ @$quotation->price }}</td>
                                <td>{{ @$quotation->discount }}</td>
                                <td>{{ @$quotation->final_amount }}</td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
@push('script-page')
<script>
// create op modal js
$(document).on('change', '#product_type', function() {
    var productType = $(this).val();
    var repeaterButtons = $('.opp_repeater_buttons');
  
    if (productType === 'Network') 
    {
        repeaterButtons.show();
    } 
    else
    {
        repeaterButtons.hide();
        // Remove all the rows except the first one
        $('.co-repeater:not(:first)').remove();
    }
});

$(document).on('change', '.product-select', function() {
    var $row = $(this).closest('.co-repeater');
    var $quantityInput = $row.find('.quantityInput');
    var $priceInput = $row.find('.price-input');
    
    var productId = $(this).val();
    
    if (productId !== '') {
        // Make an AJAX request to fetch the product price
        $.ajax({
            url: '/get-product-price',
            type: 'GET',
            data: { productId: productId },
            success: function(response) {
                // Update the price input with the fetched price
                var productPrice = response.price;
                var quantity = parseInt($quantityInput.val());
                console.log($quantityInput.val());
                var totalPrice = parseFloat(productPrice) * quantity;
                $priceInput.val(totalPrice);
            },
            error: function() {
                // Handle error if the AJAX request fails
                console.log('Error occurred while fetching the product price.');
            }
        });
    } else {
        // Clear the price input if no product is selected
        $priceInput.val('');
    }
});

$(document).on('click', '.increaseButton', function() {
    var row = $(this).closest('.co-repeater');
    var quantityInput = row.find('.quantityInput');
    var priceInput = row.find('.price-input');
    
    var price = parseFloat(priceInput.val());
    var quantity = parseInt(quantityInput.val());
    
    if (!isNaN(quantity) && !isNaN(price)) {
        var unitPrice = price / quantity;
        quantity++;
        quantityInput.val(quantity);
        var updatedPrice = unitPrice * quantity;
        priceInput.val(updatedPrice);
    }
});

$(document).on('click', '.decreaseButton', function() {
    var row = $(this).closest('.co-repeater');
    var quantityInput = row.find('.quantityInput');
    var priceInput = row.find('.price-input');

    var price = parseFloat(priceInput.val());
    var quantity = parseInt(quantityInput.val());

    if (!isNaN(quantity) && quantity > 1 && !isNaN(price)) {
        var unitPrice = price / quantity;
        quantity--;
        quantityInput.val(quantity);
        var updatedPrice = unitPrice.toFixed(2) * quantity;
        priceInput.val(updatedPrice);
    }
});

// Add row
$(document).on('click', '#co-add-field', function() {
    if($('#product_type').val() == 'Network'){
        const container = $('.repeater');
        const lastRow = $('.co-repeater:last');
        if (lastRow.length) {
            const newRow = lastRow.clone(true);
            newRow.find('.clear').val('');
            newRow.find('select').prop('selectedIndex', 0);
            newRow.insertBefore($(this).parent());
        } else {
            console.error('No row to clone found');
        }
    }
});

// Remove row
$(document).on('click', '#co-remove-field', function() {
    if($('#product_type').val() == 'Network'){
        
        if ($('.co-repeater').length > 1) {
            $('.co-repeater:last').remove();
        } else {
            console.log('Cannot remove the only row');
        }
    }
});
// create op modal js

// edit op modal js
$(document).on('change', '#eproduct_type', function() {
    var productType = $(this).val();
    var addButton = $('.eop_repeater_buttons');
    var deleteButton = $('.edeleteButton');
  
    if (productType === 'Network') 
    {
        addButton.show();
        deleteButton.show();
    } 
    else
    {
        addButton.hide();
        deleteButton.hide();
        // Remove all the rows except the first one
        $('.eco-repeater:not(:first)').remove();
    }
});

$(document).on('change', '.eproduct-select', function() {
    var $row = $(this).closest('.eco-repeater');
    var $quantityInput = $row.find('.quantityInput');
    var $priceInput = $row.find('.price-input');
    
    var productId = $(this).val();
    
    if (productId !== '') {
        // Make an AJAX request to fetch the product price
        $.ajax({
            url: '/get-product-price',
            type: 'GET',
            data: { productId: productId },
            success: function(response) {
                // Update the price input with the fetched price
                var productPrice = response.price;
                var quantity = parseInt($quantityInput.val());
                var totalPrice = parseFloat(productPrice) * quantity;
                console.log($quantityInput.val(),productPrice);
                $priceInput.val(totalPrice);
            },
            error: function() {
                // Handle error if the AJAX request fails
                console.log('Error occurred while fetching the product price.');
            }
        });
    } else {
        // Clear the price input if no product is selected
        $priceInput.val('');
    }
});

$(document).on('click', '.eincreaseButton', function() {
    var row = $(this).closest('.eco-repeater');
    var quantityInput = row.find('.quantityInput');
    var priceInput = row.find('.price-input');
    
    var price = parseFloat(priceInput.val());
    var quantity = parseInt(quantityInput.val());
    
    if (!isNaN(quantity) && !isNaN(price)) {
        var unitPrice = price / quantity;
        quantity++;
        quantityInput.val(quantity);
        var updatedPrice = unitPrice * quantity;
        priceInput.val(updatedPrice);
    }
});

$(document).on('click', '.edecreaseButton', function() {
    var row = $(this).closest('.eco-repeater');
    var quantityInput = row.find('.quantityInput');
    var priceInput = row.find('.price-input');

    var price = parseFloat(priceInput.val());
    var quantity = parseInt(quantityInput.val());

    if (!isNaN(quantity) && quantity > 1 && !isNaN(price)) {
        var unitPrice = price / quantity;
        quantity--;
        quantityInput.val(quantity);
        var updatedPrice = unitPrice.toFixed(2) * quantity;
        priceInput.val(updatedPrice);
    }
});

$(document).on('click', '#eco-add-field', function() {
    const container = $('.erepeater');
    const lastRow = $('.eco-repeater:last');
    if (lastRow.length) {
        const newRow = lastRow.clone(true);
        newRow.find('input').val('');
        newRow.find('select').prop('selectedIndex', 0);
        newRow.find('.quantityInput').val(1);
        newRow.find('.op_id').val(0);
        newRow.insertBefore($(this).closest('.eop_repeater_buttons'));
    } else {
        console.error('No row to clone found');
    }
});

$(document).on('click', '#eco-remove-field', function() {
    const row = $(this).closest('.eco-repeater');
    if ($('.eco-repeater').length > 1) {
        row.remove();
    } else {
        console.log('Cannot remove the only row');
    }
});
// edit op modal js
</script>
@endpush
