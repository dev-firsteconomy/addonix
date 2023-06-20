{{Form::open(array('url'=>'sendPerforma','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    @csrf
    {{Form::hidden('lead_id',$lead->id,array('class'=>'form-control','required'=>'required'))}}
    <div class="col-3">
        <div class="form-group">
            {{Form::label('invoice_no',__('Invoice No'),['class'=>'form-label']) }}
            {{Form::text('invoice_no',null,array('class'=>'form-control','required'=>'required', 'id' => 'invoice_no', 'readonly'=>'readonly'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('date',__('Dated'),['class'=>'form-label']) }}
            <input type="date" name="date" class="form-control" value="<?php echo isset($_REQUEST['date']) ? $_REQUEST['date'] : ''; ?>" >
            <!-- {{Form::date('date1',null,array('class'=>'form-control','required'=>'required', 'id' => 'date', 'readonly'=>'readonly'))}} -->
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('buyers_order_no',__('Buyers Order No'),['class'=>'form-label']) }}
            {{Form::text('buyers_order_no',null,array('class'=>'form-control','required'=>'required', 'id' => 'buyers_order_no', 'readonly'=>'readonly'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('buyer',__('Buyer'),['class'=>'form-label']) }}
            {{Form::text('buyer',$lead->company_name,array('class'=>'form-control','required'=>'required', 'id' => 'buyer', 'readonly'=>'readonly'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('address',__('Address'),['class'=>'form-label']) }}
            {{Form::text('address',$lead->lead_address,array('class'=>'form-control','required'=>'required', 'id' => 'address', 'readonly'=>'readonly'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('to_name',__('Kind Attn'),['class'=>'form-label']) }}
            {{Form::text('to_name',null,array('class'=>'form-control','required'=>'required', 'id' => 'to_name', 'readonly'=>'readonly'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('gst_no',__('GST NO'),['class'=>'form-label']) }}
            {{Form::text('gst_no',null,array('class'=>'form-control','required'=>'required', 'id' => 'gst_no', 'readonly'=>'readonly'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
            {{ Form::select('product_id',$products,null,array('class'=>'form-control','required'=>'required', 'id' => 'product-select')) }}
        </div>
    </div>
    <div class="col-3">
        {{Form::label('quantity',__('Quantity'),['class'=>'form-label']) }}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-secondary" id="decreaseButton">-</button>
            </div>
            <input type="text" class="form-control" id="quantityInput" value="1" name="quantity">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary" id="increaseButton">+</button>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('price',__('Price'),['class'=>'form-label']) }}
            {{Form::text('price',null,array('class'=>'form-control','required'=>'required', 'id' => 'price-input', 'readonly'=>'readonly'))}}
        </div>
    </div>    
    <div class="col-3">
        <div class="form-group">
            {{Form::label('discount',__('Discount'),['class'=>'form-label']) }}
            {{Form::select('discount',[''=>'Select Discount','0'=>'No Discount','10'=>'10%','20'=>'20%','30'=>'30%',
                '50'=>'50%'],null,array('class'=>'form-control','required'=>'required', 'id' => 'discount-input'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::label('final_amount',__('Final Amount'),['class'=>'form-label']) }}
            {{Form::text('final_amount',null,array('class'=>'form-control','required'=>'required', 'id' => 'final-amount', 'readonly'=>'readonly'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Download'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
