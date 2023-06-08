{{Form::open(array('url'=>'sendQuotation','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
<!-- 
    <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Send Quotation</h3>
        </div>
    </div> -->
    {{Form::hidden('lead_id',$lead->id,array('class'=>'form-control','required'=>'required'))}}
    @csrf
    <div class="col-3">
        <div class="form-group">
            {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
            {{ Form::select('product_id',$products,null,array('class'=>'form-control','required'=>'required', 'id' => 'product-select')) }}
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
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
