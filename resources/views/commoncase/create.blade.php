{{Form::open(array('url'=>'commoncases','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('status',__('Status'),['class'=>'form-label']) }}
            {!!Form::select('status', $status, null,array('class' => 'form-control ','required'=>'required')) !!}
        </div>
    </div>

    @if($type == 'account')
        <div class="col-6">
            <div class="form-group">
                {{Form::label('account',__('Account'),['class'=>'form-label']) }}
                {!!Form::select('account', $account, $id,array('class' => 'form-control ')) !!}
            </div>
        </div>
    @else
        <div class="col-6">
            <div class="form-group">
                {{Form::label('account',__('Account'),['class'=>'form-label']) }}
                {!! Form::select('account', $account, null,array('class' => 'form-control ')) !!}
            </div>
        </div>
    @endif
    <div class="col-6">
        <div class="form-group">
            {{Form::label('priority',__('Priority'),['class'=>'form-label']) }}
            {!!Form::select('priority', $priority, null,array('class' => 'form-control ','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contacts',__('Contact'),['class'=>'form-label']) }}
            {!!Form::select('contacts', $contact_name, null,array('class' => 'form-control ')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('type',__('Type'),['class'=>'form-label']) }}
            {!!Form::select('type', $case_type, null,array('class' => 'form-control ','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('User',__('Assigned User'),['class'=>'form-label']) }}
            {!! Form::select('user', $user, null,array('class' => 'form-control ')) !!}
        </div>
    </div>

    {{-- <div class="col-6 mb-3 field" data-name="attachments">
         <div class="form-group">
        <div class="attachment-upload">
            <div class="attachment-button">
                <div class="pull-left">
                    {{Form::label('User',__('Attachment'),['class'=>'form-label']) }}
                    {{Form::file('attachments',array('class'=>'form-control'))}}
                    <input type="file"name="attachment" class="form-control mb-3" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    <img id="blah" width="20%" height="20%"/>
                </div>
            </div>
            <div class="attachments"></div>
        </div>
    </div> --}}
    </div>
</div>


<div class="col-12">
    <div class="form-group">
        {{Form::label('description',__('Description'),['class'=>'form-label']) }}
        {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))}}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal">Close</button>
        {{Form::submit(__('Save'),array('class'=>'btn  btn-primary '))}}{{Form::close()}}
</div>
</div>
{{Form::close()}}
