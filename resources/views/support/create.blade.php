@extends('layouts.admin')

@section('page-title')
    {{__('Lead Create')}}
@endsection

@section('title')
<div class="page-header-title">
    {{__('Create Lead')}}
</div>
@endsection

@section('action-btn')
<div class="btn-group" role="group">
    <div class="action-btn  ms-2">
        <a href="{{ route('lead.index') }}" class="btn btn-sm btn-primary btn-icon m-1">
            Back
        </a>
    </div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Support')}}</a></li>
<li class="breadcrumb-item">{{__('Create')}}</li>
@endsection

@section('content')

{{Form::open(array('url'=>'support','method'=>'post'))}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('ticket_type',__('Ticket Type'),['class'=>'form-label']) }}
            {{ Form::select('ticket_type', [
                    '' => 'Select Option',
                    'Audit' => 'Audit',
                    'Whats New' => 'Whats New',
                    'Tips & Trick' => 'Tips & Trick',
                    'Productivity Training' => 'Productivity Training',
                    'New Installaltion' => 'New Installaltion',
                    'Upgradation' => 'Upgradation',
                    'Certification Drive' => 'Certification Drive',
                    'Service Request' => 'Service Request',
                    'Disable Request' => 'Disable Request',
                    'Enhancement' => 'Enhancement',
                    'Free Training' => 'Free Training',
                    'Paid Training' => 'Paid Training'
                ], 'ticket_type', ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('ticket_source',__('Ticket Source'),['class'=>'form-label']) }}
            {{ Form::select('ticket_source', [
                    '' => 'Select Option',
                    'Call' => 'Call',
                    'Email' => 'Email',
                    'Other' => 'Other'
                ], 'ticket_source', ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('support_mode',__('Ticket Source'),['class'=>'form-label']) }}
            {{ Form::select('support_mode', [
                    '' => 'Select Option',
                    'Call/Remote' => 'Call/Remote',
                    'Onsite' => 'Onsite'
                ], 'support_mode', ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('sr_spr',__('SR/SPR'),['class'=>'form-label']) }}
            {{ Form::select('sr_spr', [
                    '' => 'Select Option',
                    'SR' => 'SR',
                    'SPR' => 'SPR',
                    'NA' => 'NA'
                ], 'sr_spr', ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('sr_spr_no',__('SR SPR NO'),['class'=>'form-label']) }}
            {{Form::text('sr_spr_no',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter SR/SPR No')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('lead_id',__('Company Name'),['class'=>'form-label']) }}
            {!! Form::select('lead_id', $company, null,array('class' => 'form-control','required'=>'required','id'=>'lead_id')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('poc_id',__('Person Name'),['class'=>'form-label']) }}
            {!! Form::select('poc_id', [], null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('mobile',__('mobile'),['class'=>'form-label']) }}
            {{Form::text('mobile',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter Mobile No')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('email',__('email'),['class'=>'form-label']) }}
            {{Form::text('email',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter Email')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('license',__('license'),['class'=>'form-label']) }}
            {{Form::text('license',null,array('class'=>'form-control','required'=>'required','placeholder'=>__('Enter License')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('product_id',__('Product Name'),['class'=>'form-label']) }}
            {!! Form::select('product_id', [], null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('subscription_end_date',__('Subscription End Date'),['class'=>'form-label']) }}
            {{Form::date('subscription_end_date',null,array('class'=>'form-control','required'=>'required', 'id' => 'subscription_end_date'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_type',__('Contract Type'),['class'=>'form-label']) }}
            {{ Form::select('contract_type', [
                    '' => 'Select Option',
                    'In Sub' => 'In Sub',
                    'Out Sub' => 'Out Sub'
                ], 'contract_type', ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('contract_sub_type',__('Contract Sub Type'),['class'=>'form-label']) }}
            {{ Form::select('contract_sub_type', [
                    '' => 'Select Option',
                    'Paid' => 'Paid',
                    'Courtesy' => 'Courtesy'
                ], 'contract_sub_type', ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('problem_observed',__('Problem Observed'),['class'=>'form-label']) }}
            {{Form::textarea('problem_observed',null,array('class'=>'form-control','placeholder'=>__('Problem Observed'),'rows'=>'3','cols'=>'10'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('solution_provided',__('Solution Provided'),['class'=>'form-label']) }}
            {{Form::textarea('solution_provided',null,array('class'=>'form-control','placeholder'=>__('Solution Provided'),'rows'=>'3','cols'=>'10'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('status',__('Status'),['class'=>'form-label']) }}
            {{ Form::select('status', [
                    '' => 'Select Option',
                    'New' => 'New',
                    'Assigned' => 'Assigned',
                    'Pending' => 'Pending',
                    'Customer Side Pending' => 'Customer Side Pending',
                    'Under Observation' => 'Under Observation',
                    'Closed' => 'Closed',
                    'Reopen' => 'Reopen'
                ], 'status', ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            {{Form::submit(__('Save'),array('class'=>'btn  btn-primary '))}}{{Form::close()}}
    </div>
</div>
{{Form::close()}}

@endsection

@push('script-page')
<script>
$(document).ready(function() {

    $(document).on('change', '#lead_id', function() {
        var lead_id = $(this).val();
        // Perform AJAX request to retrieve data for select2 options
        $.ajax({
            url: '/get-poc-options',
            method: 'GET',
            data: {
                id: lead_id,
            },
            dataType: 'json',
            success: function(response) {
                // Clear existing options in select2
                $('#poc_id').empty();

                // Append the first option as "Select Person"
                $('#poc_id').append($('<option>', {
                    value: '',
                    text: 'Select Person'
                }));

                // Iterate over the response and append options
                $.each(response, function(key, value) {
                    $('#poc_id').append($('<option>', {
                        value: key,
                        text: value
                    }));
                });

                // Refresh the select2 plugin to reflect the new options
                $('#poc_id').trigger('change');
            },
            error: function() {
                console.log('Error occurred while retrieving options.');
            }
        });

        //License
        // $.ajax({
        //     url: '/get-license-options',
        //     method: 'GET',
        //     data: {
        //         id: lead_id,
        //     },
        //     dataType: 'json',
        //     success: function(response) {
        //         // Clear existing options in select2
        //         $('#poc_id').empty();

        //         // Append the first option as "Select Person"
        //         $('#poc_id').append($('<option>', {
        //             value: '',
        //             text: 'Select Person'
        //         }));

        //         // Iterate over the response and append options
        //         $.each(response, function(key, value) {
        //             $('#poc_id').append($('<option>', {
        //                 value: key,
        //                 text: value
        //             }));
        //         });

        //         // Refresh the select2 plugin to reflect the new options
        //         $('#poc_id').trigger('change');
        //     },
        //     error: function() {
        //         console.log('Error occurred while retrieving options.');
        //     }
        // });
    });

    $(document).on('change', '#poc_id', function() {
        var poc_id = $(this).val();
        // Perform AJAX request to retrieve data for select2 options
        $.ajax({
            url: '/get-poc-data',
            method: 'GET',
            data: {
                poc_id: poc_id,
            },
            dataType: 'json',
            success: function(response) {
                // Clear existing options in select2
                $('#mobile').val(response.contact_number);
                $('#email').val(response.email_id);

            },
            error: function() {
                console.log('Error occurred while retrieving options.');
            }
        });
    });

    $('#license').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/license/search",
                type: "GET",
                dataType:"json",
                data: {
                    term: $('#license').val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 3,
        select: function(event, ui) {
        var selectedLicense = ui.item.value;

        // Perform AJAX call to get products mapped with the selected license
        // get products
        $.ajax({
            url: "/get-license-products",
            type: "GET",
            dataType: "json",
            data: {
                license: selectedLicense
            },
            success: function(response ) {
                // Process the response data and update your page accordingly
                console.log(response );

                // Clear existing options in select2
                $('#product_id').empty();

                // Append the first option as "Select Person"
                $('#product_id').append($('<option>', {
                    value: '',
                    text: 'Select Product'
                }));

                // Iterate over the response and append options
                $.each(response, function(key, value) {
                    $('#product_id').append($('<option>', {
                        value: key,
                        text: value
                    }));
                });

                // Refresh the select2 plugin to reflect the new options
                $('#product_id').trigger('change');
            }
        });
        // get products

        // get subscription date
        $.ajax({
            url: "/get-subscription-end-date",
            type: "GET",
            dataType: "json",
            data: {
                license: selectedLicense
            },
            success: function(response) {
                // Process the response data and update your page accordingly
                console.log(response );

                // Set the date value in the date input field
                $('#subscription_end_date').val(response.subscription_end_date);
            }
        });
        // get subscription date
    }
    });

});
</script>
@endpush