@extends('layouts.admin')

@section('title')
<div class="page-header-title">
    {{__('View Opportunity')}}
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
        <a href="{{ request()->headers->get('referer') }}" class="btn btn-sm btn-primary btn-icon m-1">
            Back
        </a>
    </div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Lead')}}</a></li>
<li class="breadcrumb-item">{{__('View Opportunity')}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <!-- Opportunity Section -->
            <dl class="row table-data">
                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Date Created')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->date_created }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Product Type')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->product_type }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Point Of Contact')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->poc->name }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Sales Stage')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->sales_stage }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Close Date')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->close_date }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Assigned To')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->assigned_to }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Status')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->status }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('cbi_identified')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->cbi_identified }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Feedback')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->feedback }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Created By')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->created_by }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Created At')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $opportunity->created_at }}</span></dd>
            </dl>
            <!-- Opportunity Section -->
            
            <dl class="row viewData">
                <!-- Product Section -->
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
                                    <p class="mb-0">Quantity</p>
                                </th>
                                <th>
                                    <p class="mb-0">Price</p>
                                </th>
                                <th>
                                    <p class="mb-0">Discount</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($opportunity->opportunity_products as $item)
                            <?php 
                                $product = \App\Models\Product::find($item->product_id);
                            ?>
                            <tr>
                                <td scope="col">{{ $i}}</td>
                                <td scope="col">{{ $product->name}}</td>
                                <td scope="col">{{ $item->quantity}}</td>
                                <td scope="col">{{ $item->price}}</td>
                                <td scope="col">{{ $item->discount > 0 ? $item->discount : '-'}}</td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="btn-center">
                    <a href="javascript:void(0)" data-url="{{ route('addSubscription',$opportunity->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="Create New Subscription" title="" class="btn btn-sm btn-primary btn-icon m-1">
                        Add Products
                    </a>
                </div>
                <!-- Product Section -->
            </dl>
        </div>
    </div>
</div>
@endsection
@push('script-page')
<script>
// create op modal js
$(document).on('change', '#subscription_product_type', function() {
    var productType = $(this).val();
    var repeaterButtons = $('.subscription_repeater_buttons');
  
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

$(document).on('change', '.subscription-product-select', function() {
    var $row = $(this).closest('.co-repeater');
    var $quantityInput = $row.find('.subscription-quantityInput');
    var $priceInput = $row.find('.subscription-price-input');
    
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

$(document).on('click', '.subscription-increaseButton', function() {
    var row = $(this).closest('.subscription-repeater');
    var quantityInput = row.find('.subscription-quantityInput');
    // var priceInput = row.find('.subscription-price-input');
    
    // var price = parseFloat(priceInput.val());
    var quantity = parseInt(quantityInput.val());
    
    // if (!isNaN(quantity) && !isNaN(price)) {
        // var unitPrice = price / quantity;
        quantity++;
        quantityInput.val(quantity);
        // var updatedPrice = unitPrice * quantity;
        // priceInput.val(updatedPrice);
    // }
});

$(document).on('click', '.subscription-decreaseButton', function() {
    var row = $(this).closest('.subscription-repeater');
    var quantityInput = row.find('.subscription-quantityInput');
    // var priceInput = row.find('.subscription-price-input');

    // var price = parseFloat(priceInput.val());
    var quantity = parseInt(quantityInput.val());

    // if (!isNaN(quantity) && quantity > 1 && !isNaN(price)) {
        // var unitPrice = price / quantity;
        if(quantity > 1){
            quantity--;
            quantityInput.val(quantity);
        }
        // var updatedPrice = unitPrice.toFixed(2) * quantity;
        // priceInput.val(updatedPrice);
    // }
});

// Add row
$(document).on('click', '#subscription-add-field', function() {
    if($('#subscription_product_type').val() == 'Network'){
        const container = $('.subscription');
        const lastRow = $('.subscription-repeater:last');
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
$(document).on('click', '#subscription-remove-field', function() {
    if($('#subscription_product_type').val() == 'Network'){
        
        if ($('.subscription-repeater').length > 1) {
            $('.subscription-repeater:last').remove();
        } else {
            console.log('Cannot remove the only row');
        }
    }
});
// create op modal js

// edit op modal js
$(document).on('change', '#subscription_product_type', function() {
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


// interaction modal js
$(document).on('change','#interaction_activity_type',function() {
    var selectedValue = $(this).val();
    if (selectedValue == 'Demo') {
        $('.demo').show();
    } else {
        $('.demo').hide();
    }
});
// interaction modal js
</script>
@endpush
