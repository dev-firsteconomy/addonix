{{Form::open(array('url'=>'submitInteraction','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Interaction Activity</h3>
        </div>
    </div>
    {{Form::hidden('lead_id',$lead->id,array('class'=>'form-control','required'=>'required'))}}
    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_activity_type',__('Interaction Activity Type'),['class'=>'form-label']) }}
            {{Form::select('interaction_activity_type',[''=>'Select Activities Type','Call'=>'Call','Meeting'=>'Meeting','Opportunity'=>'Opportunity','Demo'=>'Demo',
                'Quotation'=>'Quotation','MOM'=>'MOM','PI'=>'PI'],null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_subject',__('Subject'),['class'=>'form-label']) }}
            {{Form::text('interaction_subject',null,array('class'=>'form-control','placeholder'=>__('Enter Subject'),'required'=>'required'))}}
        </div>
    </div>   
    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_status',__('Interaction Status'),['class'=>'form-label']) }}
            {{Form::select('interaction_status',[''=>'Select Status','Scheduled'=>'Scheduled','Cancel'=>'Cancel','Done'=>'Done','Onhold'=>'Onhold'],null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_date',__('Interaction Date'),['class'=>'form-label']) }}
            {{Form::date('interaction_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_feedback',__('Interaction Feedback'),['class'=>'form-label']) }}
            {{Form::text('interaction_feedback',null,array('class'=>'form-control','placeholder'=>__('Enter Feedback'),'required'=>'required'))}}
        </div>
    </div>    
    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_followup_date',__('InteractionFollow Up Date'),['class'=>'form-label']) }}
            {{Form::date('interaction_followup_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>
    <!-- HIDDEN FIELDS -->
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
            {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))}}
        </div>
    </div> 
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('demo_date',__('Demo Date'),['class'=>'form-label']) }}
            {{Form::date('demo_date',null,array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('contact_person',__('Contact Person'),['class'=>'form-label']) }}
            {{Form::text('contact_person',null,array('class'=>'form-control','placeholder'=>__('Enter Person Name')))}}
        </div>
    </div>
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
            {{ Form::select('product_id',$products,null,array('class'=>'form-control', 'id' => 'product-select')) }}
        </div>
    </div>
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('demo_status',__('Demo Status'),['class'=>'form-label']) }}
            {{Form::select('demo_status',[''=>'Select Activities Type','Call'=>'Call','Meeting'=>'Meeting','Opportunity'=>'Opportunity','Demo'=>'Demo',
                'Quotation'=>'Quotation','MOM'=>'MOM','PI'=>'PI'],null,array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('oft_unique_id',__('OFT Unique Id'),['class'=>'form-label']) }}
            {{Form::text('oft_unique_id',null,array('class'=>'form-control','placeholder'=>__('Enter OFT ID')))}}
        </div>
    </div>  
    <div class="col-4 demo" style="display:none;">
        <div class="form-group">
            {{Form::label('assign_user_id',__('Assigned To'),['class'=>'form-label']) }}
            @php 
                $userOptions = App\Models\User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
                $userOptions->prepend('Select Owner', '');
            @endphp
            {!! Form::select('assign_user_id',$userOptions, null,array('class' => 'form-control')) !!}
        </div>
    </div> 
    <!-- HIDDEN FIELDS -->
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
