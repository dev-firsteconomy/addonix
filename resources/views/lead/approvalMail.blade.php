{{Form::open(array('url'=>'sendApprovalEmail','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    @csrf
    {{Form::hidden('lead_id',$lead->id,array('class'=>'form-control', 'id'=>'lead_id'))}}
    {{Form::hidden('opportunity_id',$opportunity->id,array('class'=>'form-control', 'id'=>'opportunity_id'))}}
    <div class="col-6">
        <div class="form-group">
            {{Form::label('to_email',__('To Email'),['class'=>'form-label']) }}
            {{Form::email('to_email',$lead->email,array('class'=>'form-control','required'=>'required', 'id'=>'to_email'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_to_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('cc_email',__('CC Email'),['class'=>'form-label']) }}
            {{Form::text('cc_email',null,array('class'=>'form-control','required'=>'required', 'id'=>'cc_email', 'placeholder'=>__('Enter CC EMAIL COMMA SEPRATED')))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('company_name',__('Account Name'),['class'=>'form-label']) }}
            {{Form::text('company_name',$lead->company_name,array('class'=>'form-control','required'=>'required', 'id'=>'email_company_name'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('parent_companyy_name',__('Parent / Sister / Group Company name'),['class'=>'form-label']) }}
            {{Form::text('parent_companyy_name',$lead->parent_companyy_name,array('class'=>'form-control', 'id'=>'email_parent_companyy_name'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('lead_address',__('Full Address'),['class'=>'form-label']) }}
            {{Form::text('lead_address',$lead->lead_address,array('class'=>'form-control','required'=>'required', 'id'=>'email_lead_address'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('website',__('Website'),['class'=>'form-label']) }}
            {{Form::text('website',$lead->website,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter Website')))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('existing_customer',__('Existing Customer'),['class'=>'form-label']) }}
            {{ Form::select('existing_customer', [
                    '' => 'Select Option',
                    'Yes' => 'Yes',
                    'No' => 'No'
                ], $lead->existing_customer, ['class' => 'form-control','required'=>'required']) 
            }}
            <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('cbi_identified',__('Cbi Identified'),['class'=>'form-label']) }}
            {{Form::text('cbi_identified',$opportunity->cbi_identified,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('met_or_spoke',__('Met Or Spoke to Person'),['class'=>'form-label']) }}
            {{ Form::select('met_or_spoke', [
                '' => 'Select Option',
                'MEET IN PERSON' => 'MEET IN PERSON',
                'CALL' => 'CALL'
            ],$lead->met_or_spoke, ['class' => 'form-control','required'=>'required']) }}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('poc_name',__('Whom did you speak to'),['class'=>'form-label']) }}
            {!! Form::select('poc_name', $poc, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('is_mnc',__('If an MNC'),['class'=>'form-label']) }}
            {{ Form::select('is_mnc', [
                    '' => 'Select Option',
                    'Yes' => 'Yes',
                    'No' => 'No'
                ], $lead->is_mnc, ['class' => 'form-control','required'=>'required']) 
            }}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('product_name',__('Product'),['class'=>'form-label']) }}
            {{ Form::select('product_name',$products,null,array('class'=>'form-control eproduct-select clear','required'=>'required', 'id' => 'eproduct-select', 'required'=>'required')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Send Email'),array('class'=>'btn btn-primary', 'id'=>'sendEmailSubmit'))}}
</div>
