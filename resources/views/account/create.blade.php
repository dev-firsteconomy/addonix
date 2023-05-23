{{Form::open(array('url'=>'account','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('email',__('Email'),['class'=>'form-label']) }}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
            {{Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('website',__('Website'),['class'=>'form-label']) }}
            {{Form::text('website',null,array('class'=>'form-control','placeholder'=>__('Website'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('billingaddress',__('Billing Address'),['class'=>'form-label']) }}
            <div class="action-btn bg-primary ms-2 float-end">
            <a class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " id="billing_data" data-bs-toggle="tooltip" data-placement="top" title="{{ ('Same As Billing Address') }}"><i class="fas fa-copy"></i></a>
            <span class="clearfix"></span>
            </div>
            {{Form::text('billing_address',null,array('class'=>'form-control','placeholder'=>__('Billing Address'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('shippingaddress',__('Shipping Address'),['class'=>'form-label']) }}
            {{Form::text('shipping_address',null,array('class'=>'form-control','placeholder'=>__('Shipping Address'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('billing_city',null,array('class'=>'form-control','placeholder'=>__('Billing City'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('billing_state',null,array('class'=>'form-control','placeholder'=>__('Billing State'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('shipping_city',null,array('class'=>'form-control','placeholder'=>__('Shipping City'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('shipping_state',null,array('class'=>'form-control','placeholder'=>__('Shipping State'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('billing_country',null,array('class'=>'form-control','placeholder'=>__('Billing Country'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('billing_postalcode',null,array('class'=>'form-control','placeholder'=>__('Billing Postal Code'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('shipping_country',null,array('class'=>'form-control','placeholder'=>__('Shipping Country'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {{Form::text('shipping_postalcode',null,array('class'=>'form-control','placeholder'=>__('Shipping Postal Code'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-12">
        <hr class="mt-2 mb-2">
        <h6>{{__('Detail')}}</h6>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('type',__('Type'),['class'=>'form-label']) }}
            {!! Form::select('type', $accountype, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('Industry',__('Industry'),['class'=>'form-label']) }}
            {!! Form::select('industry', $industry, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('document_id',__('Document'),['class'=>'form-label']) }}
            {!! Form::select('document_id', $document_id, null,array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('Assign User',__('Assign User'),['class'=>'form-label']) }}
            {!! Form::select('user', $user, null,array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('Description',__('Description'),['class'=>'form-label']) }}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))}}
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal">Close</button>
        {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
