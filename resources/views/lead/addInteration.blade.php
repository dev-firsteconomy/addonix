{{Form::open(array('url'=>'submitInteraction','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">

    <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Interaction Activity</h3>
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
            {{Form::label('interaction_activity_type',__('Interaction Activity Type'),['class'=>'form-label']) }}
            {{Form::select('interaction_activity_type',[''=>'Select Activities Type','Call'=>'Call','Meeting'=>'Meeting','Opportunity'=>'Opportunity','Demo'=>'Demo',
                'Quotation'=>'Quotation','MOM'=>'MOM','PI'=>'PI'],null,array('class'=>'form-control','required'=>'required'))}}
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            {{Form::label('interaction_feedback',__('Interaction Feedback'),['class'=>'form-label']) }}
            {{Form::text('interaction_feedback',null,array('class'=>'form-control','placeholder'=>__('Enter Feedback'),'required'=>'required'))}}
        </div>
    </div>    

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
