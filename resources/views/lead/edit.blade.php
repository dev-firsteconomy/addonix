@extends('layouts.admin')
@section('page-title')
    {{__('Lead Edit')}}
@endsection
@section('title')
        <div class="page-header-title">
           {{__('Edit Lead')}} {{ '('. $lead->company_name .')' }}
        </div>
@endsection
@section('action-btn')
    
    <div class="btn-group" role="group">
        @if(!empty($previous))
        <div class="action-btn  ms-2">
            <a href="{{ route('lead.edit',$previous) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        @else
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        @endif
        @if(!empty($next))
        <div class="action-btn  ms-2">
            <a href="{{ route('lead.edit',$next) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Next')}}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        @else
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Next')}}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        @endif
    </div>

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Lead')}}</a></li>
    <li class="breadcrumb-item">{{__('Details')}}</li>
@endsection
@section('content')


<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            
            <!-- <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Overview') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{__('Stream')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{__('Tasks')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div> -->
           
            <div class="col-xl-12">
                @if (Session::has('message'))
                <div id="success-message" class="alert alert-success" role="alert" >
                    {{ Session::get('message') }}
                </div>
                @endif
                <div id="useradd-1" class="card">
                    {{Form::model($lead,array('route' => array('lead.update', $lead->id), 'method' => 'PUT')) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{__('Edit About Your Lead Information')}}</small>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        {{Form::label('Source',__('Source'),['class'=>'form-label']) }}
                                        {{Form::select('source',[''=>'Select source','Referral'=>'Referral','Digital'=>'Digital','Offline'=>'Offline','Other'=>'Other'],$lead->source,array('class'=>'form-control'))}}
                                        @error('source')
                                        <span class="invalid-source" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
                                        {{Form::text('company_name',$lead->company_name,array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))}}
                                        @error('company_name')
                                        <span class="invalid-company_name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('parent_company_name',__('Parent Company Name'),['class'=>'form-label']) }}
                                        {{Form::text('parent_company_name',$lead->parent_company_name,array('class'=>'form-control','placeholder'=>__('Enter Parent Comapny Name')))}}
                                        @error('parent_company_name')
                                        <span class="invalid-parent_company_name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('lead_address',__('Company Address'),['class'=>'form-label']) }}
                                        {{Form::text('lead_address',$lead->lead_address,array('class'=>'form-control','placeholder'=>__('Enter Company Address')))}}
                                        @error('lead_address')
                                        <span class="invalid-lead_address" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('phone',__('Contact No.'),['class'=>'form-label']) }}
                                        {{Form::text('phone',$lead->phone,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required', 'maxLength'=>'10'))}}
                                        @error('phone')
                                        <span class="invalid-phone" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                        {{Form::text('email',$lead->email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                        @error('email')
                                        <span class="invalid-company_email" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('website',__('Website'),['class'=>'form-label']) }}
                                        {{Form::text('website',$lead->website,array('class'=>'form-control','placeholder'=>__('Enter Website')))}}
                                        @error('website')
                                        <span class="invalid-website" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('existing_customer',__('Existing Customer'),['class'=>'form-label']) }}
                                        {{ Form::select('existing_customer', [
                                                '' => 'Select Option',
                                                'Yes' => 'Yes',
                                                'No' => 'No'
                                            ], $lead->existing_customer, ['class' => 'form-control']) 
                                        }}
                                        @error('existing_customer')
                                        <span class="invalid-existing_customer" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('type',__('Type'),['class'=>'form-label']) }}

                                        <?php
                                        if(!empty($lead->industryProduct) && !empty($lead->lead_interaction) && $lead->mail_sent == 1)
                                        {
                                            $typeOptions = [
                                                ''=>'Select Lead Type',
                                                'Lead' => 'Lead',
                                                'Opportunity' => 'Opportunity',
                                                // 'Active Customer' => 'Active Customer',
                                                // 'Non Active Customer' => 'Non Active Customer',
                                                'Dead' => 'Dead',
                                            ];
                                        }else{
                                            $typeOptions = [
                                                ''=>'Select Lead Type',
                                                'Lead' => 'Lead',
                                                'Dead' => 'Dead',
                                            ];
                                        }
                                        ?>
                                        {!! Form::select('type',$typeOptions, $lead->type,array('class' => 'form-control')) !!}
                                        @error('type')
                                        <span class="invalid-type" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('cbi_identified',__('CBI’s identified'),['class'=>'form-label']) }}
                                        {{Form::text('cbi_identified',$lead->cbi_identified,array('class'=>'form-control','placeholder'=>__('Enter CBI’s identified')))}}
                                        @error('cbi_identified')
                                        <span class="invalid-cbi_identified" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('met_or_spoke',__('Met Or Spoke to Person'),['class'=>'form-label']) }}
                                        {{ Form::select('met_or_spoke', [
                                            '' => 'Select Option',
                                            'MEET IN PERSON' => 'MEET IN PERSON',
                                            'CALL' => 'CALL'
                                        ],$lead->met_or_spoke, ['class' => 'form-control']) }}
                                        @error('existing_customer')
                                        <span class="invalid-existing_customer" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('is_mnc',__('If an MNC'),['class'=>'form-label']) }}
                                        {{ Form::select('is_mnc', [
                                                '' => 'Select Option',
                                                'Yes' => 'Yes',
                                                'No' => 'No'
                                            ], $lead->is_mnc, ['class' => 'form-control']) 
                                        }}
                                        @error('existing_customer')
                                        <span class="invalid-is_mnc" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('industry_vertical',__('Industry Vertical'),['class'=>'form-label']) }}
                                        {{Form::select('industry_vertical',[''=>'Select Industry Vertical','Machining'=>'Machining',
                                            'Manufacturing'=>'Manufacturing','Aerospace'=>'Aerospace','Transportation & Automotive'=>'Transportation & Automotive',
                                            'Oil & Gas'=>'Oil & Gas','Safety'=>'Safety','Construction'=>'Construction' , 'Utilities'=>'Utilities','Government and Military Entities'=>'Government and Military Entities'
                                            ],$lead->industry_vertical,array('class'=>'form-control'))}}
                                        @error('industry_vertical')
                                            <span class="invalid-industry_vertical" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('sales_stage',__('Sales Stage'),['class'=>'form-label']) }}
                                        {{ Form::select('sales_stage', [
                                                '' => 'Select Option',
                                                'W' => 'W',
                                                'NW' => 'NW',
                                                'A+' => 'A+',
                                                'A' => 'A',
                                                'B' => 'B',
                                            ], $lead->sales_stage, ['class' => 'form-control']) }}
                                        @error('sales_stage')
                                            <span class="invalid-sales_stage" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                            {{Form::label('create_date',__('Creation Date'),['class'=>'form-label']) }}
                                            <input type="date" name="create_date" class="form-control" value="{{ $lead->create_date ? $lead->create_date : null }}" >
                                            @error('create_date')
                                            <span class="invalid-create_date" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                            {{Form::label('estimated_close_date',__('Estimated Closed Date'),['class'=>'form-label']) }}
                                            <input type="date" name="estimated_close_date" class="form-control" value="{{ $lead->estimated_close_date ? $lead->estimated_close_date : null }}">
                                            @error('estimated_close_date')
                                            <span class="invalid-estimated_close_date" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('assign_user_id',__(' Lead Owner'),['class'=>'form-label']) }}

                                        @php 
                                        $userOptions = App\Models\User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
                                                    $userOptions->prepend('Select Owner', '');
                                        @endphp

                                        {!! Form::select('assign_user_id',$userOptions, $lead->assign_user_id,array('class' => 'form-control')) !!}
                                        @error('assign_user_id')
                                        <span class="invalid-assign_user_id" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Point Of Contact</h5>
                </div>

                <div id="poc-repeater-container">
                    <div class="col-12 table-responsive">
                        <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <p class="mb-0">Name</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Designation</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Contact Number</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Email Id</p>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lead->industryPerson as $person)
                                <tr class="poc-repeater mt-repeater">
                                    <td><input name="poc_id[]" class="form-control" type="hidden" value="{{ $person->id }}"/></td>
                                    <td><input name="poc_name[]" class="form-control" type="text" value="{{ $person->name }}" required/></td>
                                    <td><input name="poc_designation[]" class="form-control" type="text" value="{{ $person->designation }}" required/></td>
                                    <td><input name="poc_contact_number[]" class="form-control" type="tel"  value="{{ $person->contact_number }}" maxLength="10" required/></td>
                                    <td><input name="poc_email_id[]" class="form-control" type="email" value="{{ $person->email_id }}" required/></td>
                                    <td>
                                        <button class="btn btn-danger" type="button" id="poc-remove-field"><i class="ti ti-minus"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right text-center my-2">
                            <button class="btn btn-primary" type="button" id="poc-add-field"><i class="ti ti-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Product</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th>
                                    <p class="mb-0">Product Name</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="repeater mt-repeater">
                                <td>
                                    {{ Form::select('product_name[]', $products,$selectedProducts, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'')) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                                
                                <div class="text-end">
                                    {{Form::submit(__('Update'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>


                            </div>
                        </form>
                    </div>
                    {{Form::close()}}
                </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>



@endsection
@push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>    
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000); // Hide the message after 5 seconds (adjust the timeout value as needed)
    </script>
    <script>
        document.getElementById('poc-add-field').addEventListener('click', function() {
            const container = document.getElementById('poc-repeater-container');
            const lastRow = container.querySelector('.poc-repeater:last-of-type');
            const newRow = lastRow.cloneNode(true);
            const inputs = newRow.querySelectorAll('input');

            // Clear input field values in the new row
            inputs.forEach((input,index) => {
                input.value = index == 0 ? 0 : '';
            });

            container.querySelector('tbody').appendChild(newRow);
            toggleRemoveButtons();
        });

        document.getElementById('poc-repeater-container').addEventListener('click', function(event) {
            if (event.target.id === 'poc-remove-field') {
                const repeaterRows = document.querySelectorAll('.poc-repeater');
                if (repeaterRows.length > 1) {
                    event.target.closest('.poc-repeater').remove();
                    toggleRemoveButtons();
                }
            }
        });

        function toggleRemoveButtons() {
            const repeaterRows = document.querySelectorAll('.poc-repeater');
            const removeButtons = document.querySelectorAll('#poc-repeater-container .btn-danger');

            removeButtons.forEach(button => {
                button.disabled = repeaterRows.length === 1;
            });
        }

        // Call toggleRemoveButtons initially to disable the remove button if there's only one repeater row initially
        toggleRemoveButtons();
    </script>


@endpush
