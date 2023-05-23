{{ Form::model($contract, array('route' => array('contract.update', $contract->id), 'method' => 'PUT')) }}

    <div class="row">
        <div class="col-md-6 form-group">
            {{ Form::label('name', __('Contract Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('client_name', __('User Name'),['class'=>'form-label']) }}
            {{ Form::select('client_name', $client,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('subject', __('Subject'),['class'=>'form-label']) }}
            {{ Form::text('subject', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('value', __('Value'),['class'=>'form-label']) }}
            {{ Form::number('value', null, array('class' => 'form-control','required'=>'required','min' => '1')) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
            {{ Form::select('type', $contractType,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('date', __('Start Date / End Date'),['class'=>'form-label']) }}

                <div class='input-group'>
                    <input type='text' name="date" id='pc-daterangepicker-2'
                        class="form-control" placeholder="Select date range" />
                    <span class="input-group-text"><i
                            class="feather icon-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-group">
            {{ Form::label('notes', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('notes', null, array('class' => 'form-control')) }}
        </div>

    </div>

<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
    <button type="submit" class="btn  btn-primary">{{__('Update')}}</button>

</div>

    {{ Form::close() }}

    <script>
        document.querySelector("#pc-daterangepicker-2").flatpickr({
            mode: "range"
        });
    </script>
