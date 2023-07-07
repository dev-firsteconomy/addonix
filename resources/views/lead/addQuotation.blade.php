{{Form::open(array('url'=>'sendQuotation','method'=>'post','enctype'=>'multipart/form-data'))}}
{{Form::hidden('lead_id',$lead->id,array('class'=>'form-control','required'=>'required'))}}
<div class="col-6">
    <div class="form-group">
        {{Form::label('validity',__('Quote Validity'),['class'=>'form-label']) }}
        {{Form::date('validity',null,array('class'=>'form-control','required'=>'required'))}}
    </div>
</div>
<div class="quotation-repeater-container">
    <div class="row quotation-repeater mt-repeater">
        @csrf
        <div class="col-3">
            <div class="form-group">
                {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
                {{ Form::select('product_id[]',$products,null,array('class'=>'form-control quotation-product-select','required'=>'required')) }}
            </div>
        </div>
        <div class="col-3">
            {{Form::label('quantity',__('Quantity'),['class'=>'form-label']) }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-outline-secondary quotation-decreaseButton" id="quotation-decreaseButton">-</button>
                </div>
                <input type="text" class="form-control quotation-quantityInput quotation-input-clear" id="quantityInput" value="1" name="quantity[]">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary quotation-increaseButton" id="quotation-increaseButton">+</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                {{Form::label('price',__('Price'),['class'=>'form-label']) }}
                {{Form::text('price[]',null,array('class'=>'form-control quotation-price-input quotation-input-clear','required'=>'required', 'readonly'=>'readonly'))}}
            </div>
        </div>    
        <div class="col-3">
            <div class="form-group">
                {{Form::label('discount',__('Discount'),['class'=>'form-label']) }}
                {{Form::select('discount[]',[''=>'Select Discount','0'=>'No Discount','10'=>'10%','20'=>'20%','30'=>'30%',
                    '50'=>'50%'],null,array('class'=>'form-control quotation-discount-input','required'=>'required'))}}
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                {{Form::label('final_amount',__('Final Amount'),['class'=>'form-label']) }}
                {{Form::text('final_amount[]',null,array('class'=>'form-control quotation-final-amount quotation-input-clear','required'=>'required', 'id' => 'final-amount', 'readonly'=>'readonly'))}}
            </div>
        </div>
    </div>
    <div class="pull-right text-center mb-2">
        <button class="btn btn-primary" type="button" id="quotation-add-field"><i class="ti ti-plus"></i></button>
        <button class="btn btn-danger" type="button" id="quotation-remove-field"><i class="ti ti-minus"></i></button>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Download'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
