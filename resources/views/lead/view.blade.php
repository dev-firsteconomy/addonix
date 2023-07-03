@extends('layouts.admin')

@section('title')
<div class="page-header-title">
    {{__('View Lead')}}
</div>
@endsection
<style>
.table-data {
    margin: 0px 0px 10px;;
    border-collapse: collapse;
}

.table-data >* {
    border: 1px solid #ced4da;
    padding: 6px 15px;
    border-collapse: collapse;
}

.table-data dd {
    margin-bottom: 0;
}

.table-data dt {
    text-transform: capitalize;
}

.table-data dt span.h6 {
    font-size: 14px !important;
}
.btn-center{
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
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
<li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Lead')}}</a></li>
<li class="breadcrumb-item">{{__('View Lead')}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <dl class="row table-data">
                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('source')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->source }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Parent Company Name')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->parent_company_name }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Company Name')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->company_name }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Company Address')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->lead_address }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Contact No.')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->phone }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Email')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->email }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Website')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->website }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Is Existing User')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->existing_customer }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Type')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->type }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('CBI’s identified')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->cbi_identified }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Met Or Spoke to Person')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->met_or_spoke }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('If an MNC')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->is_mnc }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Industry Vertical')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->industry_vertical }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Sales Stage')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->sales_stage }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Creation Date')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->create_date }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Estimated Closed Date')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->estimated_close_date }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Assign User')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ @$lead->assign_user_id }}</span></dd>
            </dl>

            <div class="btn-center">
                <div class="action-btn bg-info ms-2">
                    <a href="{{ route('lead.edit', $lead->id) }}"
                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                        data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                        data-title="{{ __('Edit Product') }}">
                        <i class="ti ti-edit"></i>
                    </a>
                </div>
            </div>
            
            <dl class="row viewData">
                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Point of Contacts</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
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
                                <th>
                                    <p class="mb-0">Action</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->industryPerson as $person)
                            <tr>
                                <td scope="col">{{ $i}}</td>
                                <td class="text-capitalize">{{ $person->name }}</td>
                                <td class="text-capitalize">{{ $person->designation }}</td>
                                <td>{{ $person->contact_number }}</td>
                                <td>{{ $person->email_id }}</td>
                                <td>
                                    <div>
                                    @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('lead.show', $lead->id) }}" data-size="md" data-title="{{ __('Lead Details') }}"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('Edit Lead')
                                        <div class="action-btn bg-info ms-2">
                                            <a href="javascript:void(0)" data-url="{{ route('editPoc', $person->id) }}" data-ajax-popup="true"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                data-title="{{ __('Edit Point of Contact') }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                    @endcan
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="btn-center">
                    <a href="javascript:void(0)" data-url="{{ route('addPoc',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="Create New Point of Contact" title="" class="btn btn-sm btn-primary btn-icon m-1" data-bs-original-title="Create">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Opportunities</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Product Name</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->industryProduct as $product)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td><input name="product_name[]" class="form-control" type="text" value="{{ @$product->product->name }}" readonly /></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="btn-center">
                    <a href="javascript:void(0)" data-url="{{ route('convertToOpportunityModal',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="Create New Opportunity" title="" class="btn btn-sm btn-primary btn-icon m-1" data-bs-original-title="Create">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Interaction History</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Interaction Date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Interaction Type</p>
                                </th>
                                <th>
                                    <p class="mb-0">Interaction Feedback</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->lead_interaction as $interaction)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td>{{ @$interaction->interaction_date }}</td>
                                <td>{{ @$interaction->interaction_activity_type }}</td>
                                <td>{{ @$interaction->interaction_feedback }}</td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Quotation History</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Product Name</p>
                                </th>
                                <th>
                                    <p class="mb-0">Price</p>
                                </th>
                                <th>
                                    <p class="mb-0">Discount</p>
                                </th>
                                <th>
                                    <p class="mb-0">Final Amount</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->leadQuotation as $quotation)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i }}</th>
                                <td>{{ @$quotation->product->name }}</td>
                                <td>{{ @$quotation->price }}</td>
                                <td>{{ @$quotation->discount }}</td>
                                <td>{{ @$quotation->final_amount }}</td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </dl>
        </div>
    </div>
@endsection
@push('script-page')
<script>
    // $(document).on('click', '#co-add-field', function() {
    //             console.log(123);
    //     const container = document.getElementById('co-repeater-container');
    //     const lastRow = container.querySelector('.co-repeater:last-of-type');
    //     const newRow = lastRow.cloneNode(true);
    //     const inputs = newRow.querySelectorAll('.co-repeater-input');
    //     const selects = newRow.querySelectorAll('co-repeater-select');

    //     // Clear input field values in the new row
    //     inputs.forEach(input => {
    //         input.value = '';
    //     });

    //     container.appendChild(newRow);
    // });

    // // Remove row
    // var repeaterContainer = document.getElementById('co-repeater-container');
    // $(document).on('click', '#co-remove-field', function() {
    //     console.log('co-remove-field')
    //     var repeaterRows = repeaterContainer.querySelectorAll('.co-repeater');
    //     if (repeaterRows.length > 1) {
    //         var lastRow = repeaterRows[repeaterRows.length - 1];
    //         lastRow.parentNode.removeChild(lastRow);
    //     }
    // });

    // $(document).on('click', '#co-add-field', function() {
    //     const container = document.getElementById('co-repeater-container');
    //     const lastRow   = container.querySelector('.co-repeater:last-of-type');
    //     const newRow    = lastRow.cloneNode(true);
    //     const inputs    = newRow.querySelectorAll('.co-repeater-input');
    //     const selects   = newRow.querySelectorAll('.co-repeater-select');

    //     // Clear input field values in the new row
    //     inputs.forEach(input => {
    //         input.value = '';
    //     });

    //     // Clear select field values in the new row
    //     selects.forEach(select => {
    //         select.value = '';
    //     });

    //     container.appendChild(newRow);
    // });

    // // Remove row
    // var repeaterContainer = document.getElementById('co-repeater-container');
    // $(document).on('click', '#co-remove-field', function() {
    //     var repeaterRows = repeaterContainer.querySelectorAll('.co-repeater');
    //     if (repeaterRows.length > 1) {
    //         var lastRow = repeaterRows[repeaterRows.length - 1];
    //         lastRow.parentNode.removeChild(lastRow);
    //     }
    // });

</script>
@endpush
