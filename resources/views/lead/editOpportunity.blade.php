{{Form::open(array('url'=>'editOpportunity','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    @csrf
    {{Form::hidden('opportunity_id',$opportunity->id,array('class'=>'form-control'))}}
    <div class="col-4">
        <div class="form-group">
            {{Form::label('date_created',__('Date Created'),['class'=>'form-label']) }}
            {{Form::date('date_created',$opportunity->date_created,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('poc_id',__('Person'),['class'=>'form-label']) }}
            {!! Form::select('poc_id', $poc, $opportunity->poc_id,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('sales_stage',__('Sales Stage'),['class'=>'form-label']) }}
            {{ Form::select('sales_stage', [
                    '' => 'Select Option',
                    'W' => 'W',
                    'NW' => 'NW',
                    'A+' => 'A+',
                    'A' => 'A',
                    'B' => 'B',
                ], $opportunity->sales_stage, ['class' => 'form-control','required'=>'required']) 
            }}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('close_date',__('Estimated Close Date'),['class'=>'form-label']) }}
            {{Form::date('close_date',$opportunity->close_date,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('cbi_identified',__('Cbi Identified'),['class'=>'form-label']) }}
            {{Form::text('cbi_identified',$opportunity->cbi_identified,array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('assigned_to',__('Assign To'),['class'=>'form-label']) }}
            {!! Form::select('assigned_to', $user, $opportunity->assigned_to,array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('status',__('Status'),['class'=>'form-label']) }}
            {{ Form::select('status', [
                    '' => 'Select Status',
                    'Approved' => 'Approved',
                    'Conflict' => 'Conflict',
                    'Active Customer' => 'Active Customer',
                    'Non Active Customer' => 'Non Active Customer',
                    'Dead' => 'Dead'
                ], $opportunity->status, ['class' => 'form-control']) 
            }}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('feedback',__('Feedback'),['class'=>'form-label']) }}
            {{Form::textarea('feedback',$opportunity->feedback,array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('product_type',__('Product Type'),['class'=>'form-label']) }}
            {{ Form::select('product_type', [
                    '' => 'Select Product Type',
                    'StandAlone' => 'StandAlone',
                    'Network' => 'Network'
                ], $opportunity->product_type, ['class' => 'form-control', 'id' => 'eproduct_type' ,'required'=>'required']) 
            }}
        </div>
    </div>
    <div class="erepeater mt-repeater">
        <div>
            <p class="prodcut-heading">
                Products
            </p>
        </div>
        @if(!empty($opportunity->opportunity_products))
        @foreach ($opportunity->opportunity_products as $op)
        <div class="row eco-repeater mt-repeater">
            {{Form::hidden('op_id[]',$op->id,array('class'=>'form-control op_id'))}}
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
                    {{ Form::select('product_id[]',$products,$op->product_id,array('class'=>'form-control eproduct-select clear','required'=>'required', 'id' => 'eproduct-select', 'required'=>'required')) }}
                </div>
            </div>
            <div class="col-3">
                {{Form::label('quantity',__('Quantity'),['class'=>'form-label']) }}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary edecreaseButton">-</button>
                    </div>
                    <input type="text" class="form-control quantityInput" id="quantityInput" name="quantity[]" value="{{$op->quantity}}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary eincreaseButton">+</button>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {{Form::label('price',__('Price'),['class'=>'form-label']) }}
                    {{Form::text('price[]',$op->price,array('class'=>'form-control price-input','required'=>'required', 'id' => 'price-input', 'readonly'=>'readonly'))}}
                </div>
            </div>    
            <div class="col-2">
                <div class="form-group">
                    {{Form::label('discount',__('Discount'),['class'=>'form-label']) }}
                    {{Form::select('discount[]',[''=>'Select Discount','0'=>'No Discount','10'=>'10%','20'=>'20%','30'=>'30%',
                        '50'=>'50%'],$op->discount,array('class'=>'form-control discount-input','required'=>'required', 'id' => 'discount-input'))}}
                </div>
            </div>
            <div class="col-2 edeleteButton">
                <div>
                    <button class="btn btn-danger" type="button" id="eco-remove-field"><i class="ti ti-minus"></i></button>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        <div class="eop_repeater_buttons pull-right text-center mb-2">
            <button class="btn btn-primary" type="button" id="eco-add-field"><i class="ti ti-plus"></i></button>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
