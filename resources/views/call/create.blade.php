{{-- <style type="text/css">
    /* Estilo iOS */
    .switch__container {
        margin-top: 10px;
        width: 120px;
    }
    .switch {
        visibility: hidden;
        position: absolute;
        margin-left: -9999px;
    }
    .switch+label {
        display: block;
        position: relative;
        cursor: pointer;
        outline: none;
        user-select: none;
    }
    .switch--shadow+label {
        padding: 2px;
        width: 100px;
        height: 40px;
        background-color: #DDDDDD;
        border-radius: 60px;
    }
    .switch--shadow+label:before,
    .switch--shadow+label:after {
        display: block;
        position: absolute;
        top: 1px;
        left: 1px;
        bottom: 1px;
        content: "";
    }
    .switch--shadow+label:before {
        right: 1px;
        background-color: #F1F1F1;
        border-radius: 60px;
        transition: background 0.4s;
    }
    .switch--shadow+label:after {
        width: 40px;
        background-color: #fff;
        border-radius: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        transition: all 0.4s;
    }
    .switch--shadow:checked+label:before {
        background-color: #8CE196;
    }
    .switch--shadow:checked+label:after {
        transform: translateX(60px);
    }
</style> --}}
@php

$setting = App\Models\Utility::settings();

@endphp

{{Form::open(array('url'=>'call','method'=>'post','enctype'=>'multipart/form-data'))}}
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
    <div class="col-6">
        <div class="form-group">
            {{Form::label('start_date',__('Start Date'),['class'=>'form-label']) }}
            {!!Form::date('start_date', date('Y-m-d'),array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('end_date',__('End Date'),['class'=>'form-label']) }}
            {!!Form::date('end_date', date('Y-m-d'),array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('direction',__('Direction'),['class'=>'form-label']) }}
            {!!Form::select('direction', $direction, null,array('class' => 'form-control ','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6" data-name="parent">
        <div class="form-group">
        {{Form::label('parent',__('Parent'),['class'=>'form-label'])}}
        {!!Form::select('parent', $parent, null,array('class' => 'form-control ','name'=>'parent','id'=>'parent','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6" data-name="parent">
        <div class="form-group">
            {{Form::label('parent_id',__('Parent User'),['class'=>'form-label'])}}
            <select class="form-control" name="parent_id" id="parent_id">

            </select>
        </div>
    </div>
    <div class="col-6 ">
        <div class="form-group">
            {{Form::label('Assign User',__('Assign User'),['class'=>'form-label']) }}
            {!! Form::select('user', $user, null,array('class' => 'form-control ','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('description',__('Description'),['class'=>'form-label']) }}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))}}
        </div>
    </div>

    <div class="col-12">
        <hr class="mt-2 mb-2">
        <h6>{{__('Attendees')}}</h6>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('attendees_user',__('Attendees User'),['class'=>'form-label']) }}
            {!!Form::select('attendees_user', $user, null,array('class' => 'form-control ')) !!}

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('attendees_contact',__('Attendees Contact'),['class'=>'form-label']) }}
            {!!Form::select('attendees_contact', $attendees_contact, null,array('class' => 'form-control ')) !!}

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('attendees_lead',__('Attendees Lead'),['class'=>'form-label']) }}
            {!!Form::select('attendees_lead', $attendees_lead, null,array('class' => 'form-control ')) !!}

        </div>
    </div>
    @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
    <div class="form-group col-md-6">
             <label>{{__('Synchronize in Google Calendar')}}</label>
             <div class="form-check form-switch pt-2">
               <input id="switch-shadow" class="form-check-input" value="1" name="is_check" type="checkbox">
               <label class="form-check-label" for="switch-shadow"></label>
             </div>
         </div>
         @endif
         {{-- <div class="form-group">
            <label>Synchroniz in Google Calendar ?</label>
            <div class="switch__container">
                <input id="switch-shadow" class="switch switch--shadow" value="1" name="is_check"
                    type="checkbox">
                <label for="switch-shadow"></label>
            </div>
        </div> --}}
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
    </div>
</div>
</div>
{{Form::close()}}

