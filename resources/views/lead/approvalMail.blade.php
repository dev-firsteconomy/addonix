<div class="row">
    @csrf
    {{Form::hidden('lead_id',$lead->id,array('class'=>'form-control','required'=>'required', 'id'=>'lead_id'))}}
    <div class="col-6">
        <div class="form-group">
            {{Form::label('to_email',__('To Email'),['class'=>'form-label']) }}
            {{Form::email('to_email',null,array('class'=>'form-control','required'=>'required', 'id'=>'to_email'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_to_email"></p>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('cc_email',__('CC Email'),['class'=>'form-label']) }}
            {{Form::text('cc_email',null,array('class'=>'form-control','required'=>'required', 'id'=>'cc_email'))}}
        </div>
        <p class="text-danger error-msg pl-lg-2" id="error_cc_email"></p>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Send Email'),array('class'=>'btn btn-primary', 'id'=>'sendEmailSubmit'))}}
</div>
