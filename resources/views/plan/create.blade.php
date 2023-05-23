{{ Form::open(array('url' => 'plan', 'enctype' => "multipart/form-data")) }}
<div class="row">
    <div class="col-6">
    <div class="form-group">
        {{Form::label('name',__('Name'),['class'=>'form-label'])}}
        {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))}}
    </div>
    </div>
    <div class="col-6">
    <div class="form-group ">
        {{Form::label('price',__('Price'),['class'=>'form-label'])}}
        {{Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price'),'step'=>'0.01'))}}
    </div>
    </div>
    <div class="col-6">
    <div class="form-group ">
        {{Form::label('max_user',__('Maximum User'),['class'=>'form-label'])}}
        {{Form::number('max_user',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter Plan Price')))}}
        <span class="small"><b>{{__('Note: "-1" for lifetime')}}</b></span>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group ">
        {{Form::label('max_account',__('Maximum Account'),['class'=>'form-label'])}}
        {{Form::number('max_account',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter Maximum Account')))}}
        <span class="small"><b>{{__('Note: "-1" for lifetime')}}</b></span>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
        {{Form::label('max_contact',__('Maximum Contact'),['class'=>'form-label'])}}
        {{Form::number('max_contact',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter Maximum Contact')))}}
        <span class="small"><b>{{__('Note: "-1" for lifetime')}}</b></span>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
        {{ Form::label('duration', __('Duration'),['class'=>'form-label']) }}
        {!! Form::select('duration', $arrDuration, null,array('class' => 'form-control','required'=>'required','placeholder'=>__('Enter Duration'))) !!}
    </div>
    </div>
    {{-- <div class="col-12">
    <div class="form-group">
        {{ Form::label('image', __('Image'),['class'=>'form-label']) }}
        {{ Form::file('image', array('class' => 'form-control')) }}
    </div>
    </div> --}}
    <div class="col-12">
    <div class="form-group">
        {{ Form::label('description', __('Description')) }}
        {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2','placeholder'=>__('Enter Description')]) !!}
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">{{ __('Close')  }}</button>
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary '))}}
    </div>
</div>
{{ Form::close() }}

