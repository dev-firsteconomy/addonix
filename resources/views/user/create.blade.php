@if(\Auth::user()->type == 'super admin')
{{Form::open(array('url'=>'user','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="form-group">
    {{Form::label('name',__('User Name'),['class'=>'form-label']) }}
    {{Form::text('username',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))}}
</div>
<div class="form-group">
    {{Form::label('name',__('Name'),array('class'=>'form-label')) }}
    {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))}}
</div>
<div class="form-group">
    {{Form::label('email',__('Email'),['class'=>'form-label'])}}
    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email'),'required'=>'required'))}}
</div>
<div class="form-group">
    {{Form::label('password',__('Password'),['class'=>'form-label'])}}
    {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))}}
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"    
        data-bs-dismiss="modal">Close</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary '))}}
</div>

{{Form::close()}}
@else
{{Form::open(array('url'=>'user','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('User Name'),['class'=>'form-label']) }}
            {{Form::text('username',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Title'),['class'=>'form-label']) }}
            {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Title'),'required'=>'required'))}}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Phone'),['class'=>'form-label']) }}
            {{Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group ">
            {{Form::label('name',__('Gender'),['class'=>'form-label']) }}
            {!! Form::select('gender', $gender, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-12 p-0">
        <hr class="m-0 mb-3">
        <h6>{{__('Login Details')}}</h6>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('email',__('Email'),['class'=>'form-label']) }}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('name',__('Password'),['class'=>'form-label']) }}
            {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Password'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-8">
        <div class="form-group">
            {{Form::label('user_roles',__('Roles'),['class'=>'form-label']) }}
            {!! Form::select('user_roles', $roles, null,array('class' => 'form-control ','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            {{Form::label('name',__('Is Active'),['class'=>'form-label']) }}
            <div>
                <input type="checkbox" class="form-check-input" name="is_active" checked>
            </div>
        </div>
    </div>
    <div class="col-12 p-0">
        <hr class="m-0 mb-3">
        <h6>{{__('Avatar')}}</h6>
    </div>
    <div class="col-12 mb-3 field" data-name="avatar">
        <div class="attachment-upload">
            <div class="attachment-button">
                <div class="pull-left">
                    {{-- {{Form::file('avatar',array('class'=>'form-control'))}} --}}
                        <input type="file"name="avatar" class="form-control mb-3" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img id="blah"  width="25%"  />
                </div>
            </div>
            <div class="attachment"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
                {{Form::submit(__('Save'),array('class'=>'btn  btn-primary  '))}}{{Form::close()}} 
    </div>
</div>
{{Form::close()}}



   
@endif
