<div class="row">
    <div class="col-lg-12">

        <div class="">
            <dl class="row">
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
                    <h5>Product Enquiries</h5>
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
                    <h5>Interactions Done List</h5>
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
                                <td><input class="form-control" type="text" value="{{ @$interaction->interaction_date }}" readonly /></td>
                                <td><input class="form-control" type="text" value="{{ @$interaction->interaction_activity_type }}" readonly /></td>
                                <td><input class="form-control" type="text" value="{{ @$interaction->interaction_feedback }}" readonly /></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Quotation Sent List</h5>
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
                                <td><input class="form-control" type="text" value="{{ @$quotation->product->name }}" readonly /></td>
                                <td><input class="form-control" type="text" value="{{ @$quotation->price }}" readonly /></td>
                                <td><input class="form-control" type="text" value="{{ @$quotation->discount }}" readonly /></td>
                                <td><input class="form-control" type="text" value="{{ @$quotation->final_amount }}" readonly /></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </dl>
        </div>
    </div>