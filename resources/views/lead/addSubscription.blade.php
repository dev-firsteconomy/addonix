{{Form::open(array('url'=>'createSubscription','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    @csrf
    {{Form::hidden('opportunity_id',$opportunity->id,array('class'=>'form-control','required'=>'required'))}}
    <div class="col-6">
        <div class="form-group">
            {{Form::label('lead_id',__('Company Name'),['class'=>'form-label']) }}
            {!! Form::select('lead_id', $company, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('product_type',__('Product Type'),['class'=>'form-label']) }}
            {{ Form::select('product_type', [
                    '' => 'Select Product Type',
                    'StandAlone' => 'StandAlone',
                    'Network' => 'Network'
                ], 'product_type', ['class' => 'form-control','required'=>'required', 'id' => 'subscription_product_type']) 
            }}
        </div>
    </div>
    <div class="subscription mt-repeater">
        <div>
            <p class="prodcut-heading">
                Products
            </p>
        </div>
        <div class="row subscription-repeater mt-repeater">
            <div class="col-4">
                <div class="form-group">
                    {{Form::label('license',__('License'),['class'=>'form-label']) }}
                    {{Form::text('license[]',null,array('class'=>'form-control subscription-license','required'=>'required', 'id' => 'license'))}}
                </div>
            </div>  
            <div class="col-4">
                <div class="form-group">
                    {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
                    {{ Form::select('product_id[]',$products,null,array('class'=>'form-control subscription-product-select clear', 'required'=>'required')) }}
                </div>
            </div>
            <div class="col-4">
                {{Form::label('quantity',__('Quantity'),['class'=>'form-label']) }}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary subscription-decreaseButton">-</button>
                    </div>
                    <input type="text" class="form-control subscription-quantityInput" id="quantityInput" value="1" name="quantity[]">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary subscription-increaseButton">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="subscription_repeater_buttons pull-right text-center mb-2" style="display:none">
            <button class="btn btn-primary" type="button" id="subscription-add-field"><i class="ti ti-plus"></i></button>
            <button class="btn btn-danger" type="button" id="subscription-remove-field"><i class="ti ti-minus"></i></button>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('subscription_start_date',__('Subscription Start Date'),['class'=>'form-label']) }}
            {{Form::date('subscription_start_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('subscription_end_date',__('Subscription End Date'),['class'=>'form-label']) }}
            {{Form::date('subscription_end_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_value',__('Contract Value'),['class'=>'form-label']) }}
            {{Form::text('contract_value',null,array('class'=>'form-control subscription-contract_value','required'=>'required', 'id' => 'contract_value'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_terms',__('Contract Terms'),['class'=>'form-label']) }}
            {{Form::text('contract_terms',null,array('class'=>'form-control subscription-contract_terms','required'=>'required', 'id' => 'contract_terms'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
