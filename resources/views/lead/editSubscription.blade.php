{{Form::open(array('url'=>'editSubscription','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    @csrf
    {{Form::hidden('subscription_id',$subscription->id,array('class'=>'form-control'))}}
    <div class="col-6">
        <div class="form-group">
            {{Form::label('lead_id',__('Company Name'),['class'=>'form-label']) }}
            {!! Form::select('lead_id', $company, $subscription->lead_id,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('product_type',__('Product Type'),['class'=>'form-label']) }}
            {{ Form::select('product_type', [
                    '' => 'Select Product Type',
                    'StandAlone' => 'StandAlone',
                    'Network' => 'Network'
                ], $subscription->product_type, ['class' => 'form-control','required'=>'required', 'id' => 'edit_subscription_product_type']) 
            }}
        </div>
    </div>
    <div class="editSubscription mt-repeater">
        <div>
            <p class="prodcut-heading">
                Products
            </p>
        </div>
        @if(!empty($subscription->subscriptionProducts))
        @foreach ($subscription->subscriptionProducts as $sp)
        <div class="row edit-subscription-repeater mt-repeater">
            {{Form::hidden('sp_id[]',$sp->id,array('class'=>'form-control sp_id'))}}
            <div class="col-4">
                <div class="form-group">
                    {{Form::label('license',__('License'),['class'=>'form-label']) }}
                    {{Form::text('license[]',$sp->license,array('class'=>'form-control edit-subscription-license','required'=>'required', 'id' => 'edit-license'))}}
                </div>
            </div>  
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
                    {{ Form::select('product_id[]',$products,$sp->product_id,array('class'=>'form-control edit-subscription-product-select clear', 'required'=>'required')) }}
                </div>
            </div>
            <div class="col-3">
                {{Form::label('quantity',__('Quantity'),['class'=>'form-label']) }}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary edit-subscription-decreaseButton">-</button>
                    </div>
                    <input type="text" class="form-control edit-subscription-quantityInput" id="edit-subscription-quantityInput" value="{{$sp->quantity}}" name="quantity[]">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary edit-subscription-increaseButton">+</button>
                    </div>
                </div>
            </div>
            <div class="col-2 edit-subscription-deleteButton">
                <div>
                    <button class="btn btn-danger edit-subscription-remove-field" type="button" id="edit-subscription-remove-field"><i class="ti ti-minus"></i></button>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        <div class="edit_subscription_repeater_buttons pull-right text-center mb-2">
            <button class="btn btn-primary" type="button edit-subscription-add-field" id="edit-subscription-add-field"><i class="ti ti-plus"></i></button>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('subscription_start_date',__('Subscription Start Date'),['class'=>'form-label']) }}
            {{Form::date('subscription_start_date',$subscription->subscription_start_date,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('subscription_end_date',__('Subscription End Date'),['class'=>'form-label']) }}
            {{Form::date('subscription_end_date',$subscription->subscription_end_date,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_value',__('Contract Value'),['class'=>'form-label']) }}
            {{Form::text('contract_value',$subscription->contract_value,array('class'=>'form-control subscription-contract_value','required'=>'required', 'id' => 'contract_value'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_terms',__('Contract Terms'),['class'=>'form-label']) }}
            {{Form::text('contract_terms',$subscription->contract_terms,array('class'=>'form-control subscription-contract_terms','required'=>'required', 'id' => 'contract_terms'))}}
        </div>
    </div>
    @if($subscription->is_renew)
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_sub_type',__('Contract Sub Type'),['class'=>'form-label']) }}
            {{ Form::select('contract_sub_type', [
                    '' => 'Select Contract Sub Type',
                    'OTR' => 'OTR',
                    'Backdate' => 'Backdate',
                    'Recapture ' => 'Recapture '
                ], $subscription->contract_sub_type, ['class' => 'form-control','required'=>'required', 'id' => 'edit_subscription_contract_sub_type']) 
            }}
        </div>
    </div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
