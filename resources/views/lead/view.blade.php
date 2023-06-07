<div class="row">
    <div class="col-lg-12">

        <div class="">
            <dl class="row">
                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('source')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->source }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Company Name')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->company_name }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Lead')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ !empty($lead->lead_type_id) ? $lead->lead_type_id : '-' }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Company Address')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->company_address }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Contact No.')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->company_mobile }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Email')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->company_email }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Website')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->website }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Industry Vertical')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->industry_vertical }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Assign User')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->assign_user_id }}</span></dd>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Persons</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($lead->industryPerson as $person)
                            <tr class="repeater mt-repeater">
                                <th scope="col">{{ $i}}</th>
                                <td><input name="name[]" class="form-control" type="text" value="{{ $person->name }}" readonly/></td>
                                <td><input name="designation[]" class="form-control" type="text" value="{{ $person->designation }}"  readonly/></td>
                                <td><input name="contact_number[]" class="form-control" type="tel"  value="{{ $person->contact_number }}" readonly/></td>
                                <td><input name="email_id[]" class="form-control" type="email" value="{{ $person->email_id }}"  readonly/></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                            <!-- <tr class="repeater mt-repeater">
                                <th scope="col">2</th>
                                <td><input name="name[]" class="form-control" type="text" /></td>
                                <td><input name="designation[]" class="form-control" type="text" /></td>
                                <td><input name="contact_number[]" class="form-control" type="tel" /></td>
                                <td><input name="email_id[]" class="form-control" type="email" /></td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Product</h5>
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
                                <td><input name="product_name[]" class="form-control" type="text" value="{{ $product->product_name }}" readonly /></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                            

                            <!-- <tr class="repeater mt-repeater">
                                <th scope="col">2</th>
                                <td><input name="product_name[]" class="form-control" type="text" /></td>
                                <td><input name="serial_number[]" class="form-control" type="text" /></td>
                                <td><input name="sub_start_date[]" class="form-control" type="date" /></td>
                                <td><input name="sub_end_date[]" class="form-control" type="date" /></td>
                                <td><input name="price[]" class="form-control" type="text" value="1000"
                                        style="width:120px" /></td>
                                <td><input name="sale_date[]" class="form-control" type="date" /></td>
                                <td><input name="created_by[]" class="form-control" type="text" /></td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Activities History Scroling</h5>
                </div>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('source')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $lead->source }}</span></dd>


            </dl>
        </div>

        <div class="w-100 text-end pr-2">
            @can('Edit Lead')
            <div class="action-btn bg-info ms-2">
                <a href="{{ route('lead.edit',$lead->id) }}"
                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"
                    data-title="{{__('Lead Edit')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i>
                </a>
            </div>
            @endcan
        </div>
    </div>