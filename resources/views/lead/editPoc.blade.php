{{Form::open(array('url'=>'submitEditPoc','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Add Point of Contact</h3>
        </div>
    </div>
    {{Form::hidden('poc_id',$poc->id,array('class'=>'form-control','required'=>'required'))}}
    <div class="col-4">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            {{Form::text('name',$poc->name,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>   
    <div class="col-4">
        <div class="form-group">
            {{Form::label('email_id',__('Email'),['class'=>'form-label']) }}
            {{Form::text('email_id',$poc->email_id,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
        </div>
    </div>   
    <div class="col-4">
        <div class="form-group">
            {{Form::label('contact_number',__('Phone'),['class'=>'form-label']) }}
            {{Form::text('contact_number',$poc->contact_number,array('class'=>'form-control','placeholder'=>__('Enter Contact Number'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            {{Form::label('designation',__('Designation'),['class'=>'form-label']) }}
            {{Form::text('designation',$poc->designation,array('class'=>'form-control','placeholder'=>__('Enter Designation'),'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
