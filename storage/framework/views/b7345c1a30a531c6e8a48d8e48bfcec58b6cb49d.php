<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Company Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Company Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('type',__('Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('lead_type_id',[''=>'Select Type','lead'=>'Lead','Opportunity'=>'Opportunity','Active Customer'=>'Active Customer','Non Active Customer'=>'Non Active Customer'],null,array('class'=>'form-control','required'=>'required'))); ?>

            <!-- <?php echo Form::select('type', $type, null,array('class' => 'form-control','required'=>'required')); ?> -->
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('company address',__('Company Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('company_address',null,array('class'=>'form-control','placeholder'=>__('Company Address'),'required'=>'required','rows'=>'1','cols'=>'10'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('company mobile',__('Contact No.'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('company_mobile',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('company email',__('Email'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('company_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('website',__('Website'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('website',null,array('class'=>'form-control','placeholder'=>__('Enter Website'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Industry Vertical',__('Industry Vertical'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('industry_vertical',[''=>'Select Industry Vertical','Machining'=>'Machining',
                'Manufacturing'=>'Manufacturing','Aerospace'=>'Aerospace','Transportation & Automotive'=>'Transportation & Automotive',
                'Oil & Gas'=>'Oil & Gas','Safety'=>'Safety','Construction'=>'Construction' , 'Utilities'=>'Utilities','Government and Military Entities'=>'Government and Military Entities'
                ],null,array('class'=>'form-control','required'=>'required'))); ?>

            <!-- <?php echo Form::select('industryVertical', $industryVertical, null,array('class' =>'form-control','required'=>'required')); ?> -->
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('assign_user_id',[''=>'Select User Type','User 1'=>'user 1','user 2'=>'User 2'],null,array('class'=>'form-control','required'=>'required'))); ?>

            <!-- <?php echo Form::select('user', $user, null,array('class' => 'form-control','required' => 'required')); ?> -->
        </div>
    </div>

    <div class="col-12">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Persons</h3>
        </div>
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
                <tr class="repeater mt-repeater">
                    <th scope="col">1</th>
                    <td><input name="name[]" class="form-control" type="text" /></td>
                    <td><input name="designation[]" class="form-control" type="text" /></td>
                    <td><input name="contact_number[]" class="form-control" type="tel" /></td>
                    <td><input name="email_id[]" class="form-control" type="email" /></td>
                </tr>
                <tr class="repeater mt-repeater">
                    <th scope="col">2</th>
                    <td><input name="name[]" class="form-control" type="text" /></td>
                    <td><input name="designation[]" class="form-control" type="text" /></td>
                    <td><input name="contact_number[]" class="form-control" type="tel" /></td>
                    <td><input name="email_id[]" class="form-control" type="email" /></td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="pull-right">
        <button class="" type="button" id="add-field">Add Field</button>
        </div> -->
    </div>

    <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Product</h3>
        </div>
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
                        <p class="mb-0">Serial Number</p>
                    </th>
                    <th>
                        <p class="mb-0">Subscriptiion start date</p>
                    </th>
                    <th>
                        <p class="mb-0">Subscriptiion End date</p>
                    </th>
                    <th>
                        <p class="mb-0">Price</p>
                    </th>
                    <th>
                        <p class="mb-0">Sale Date</p>
                    </th>
                    <th>
                        <p class="mb-0">Created by</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="repeater mt-repeater">
                    <th scope="col">1</th>
                    <td><input name="product_name[]" class="form-control" type="text" /></td>
                    <td><input name="serial_number[]" class="form-control" type="text" /></td>
                    <td><input name="sub_start_date[]" class="form-control" type="date" /></td>
                    <td><input name="sub_end_date[]" class="form-control" type="date" /></td>
                    <td><input name="price[]" class="form-control" type="text" value="1000" style="width:120px" /></td>
                    <td><input name="sale_date[]" class="form-control" type="date" /></td>
                    <td><input name="created_by[]" class="form-control" type="text" /></td>
                </tr>
                <tr class="repeater mt-repeater">
                    <th scope="col">2</th>
                    <td><input name="product_name[]" class="form-control" type="text" /></td>
                    <td><input name="serial_number[]" class="form-control" type="text" /></td>
                    <td><input name="sub_start_date[]" class="form-control" type="date" /></td>
                    <td><input name="sub_end_date[]" class="form-control" type="date" /></td>
                    <td><input name="price[]" class="form-control" type="text" value="1000" style="width:120px" /></td>
                    <td><input name="sale_date[]" class="form-control" type="date" /></td>
                    <td><input name="created_by[]" class="form-control" type="text" /></td>
                </tr>

            </tbody>
        </table>
        <!-- <div class="pull-right">
            <input type="button" value="Add" class="top-buffer" onclick="addRow('data')" />
        </div> -->
    </div>

    <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Activities History Scroling</h3>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('activities',__('Activities'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('activities',[''=>'Select Activities Type','1'=>'activities 1','2'=>'activities 2'],null,array('class'=>'form-control','required'=>'required'))); ?>

            <!-- <?php echo Form::select('activities', $activities, null,array('class' => 'form-control','required'=>'required')); ?> -->
        </div>
    </div>

    <!-- <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

            <?php echo Form::select('account', $account, null,array('class' => 'form-control')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('title',__('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Title'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_address',__('Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::label('lead_city',__('City'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_city',null,array('class'=>'form-control','placeholder'=>__('City'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::label('lead_state',__('State'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_state',null,array('class'=>'form-control','placeholder'=>__('State'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_postalcode',__('Postal Code'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_postalcode',null,array('class'=>'form-control','placeholder'=>__('Postal Code'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_country',__('Country'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_country',null,array('class'=>'form-control','placeholder'=>__('Country'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <hr class="mt-2 mb-2">
        <h6><?php echo e(__('Details')); ?></h6>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status',$status, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('source',__('Source'),['class'=>'form-label'])); ?>

            <?php echo Form::select('source', $leadsource, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('opportunity_amount',__('Opportunity Amount'),['class'=>'form-label'])); ?>

            <?php echo Form::number('opportunity_amount', null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <?php if($type == 'campaign'): ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('campaign',__('Campaign'),['class'=>'form-label'])); ?>

                <?php echo Form::select('campaign', $campaign, $id,array('class' => 'form-control')); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('campaign',__('Campaign'),['class'=>'form-label'])); ?>

                <?php echo Form::select('campaign', $campaign, null,array('class' => 'form-control')); ?>

            </div>
        </div>
    <?php endif; ?>
    
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

        </div>
    </div> -->

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
</div>
<?php echo e(Form::close()); ?>



<!-- 
<script>
    $(document).ready(function() {
        // Add field button click event
        $('#add-field').click(function() {
            var repeaterRow = $('.repeater').clone(); // Clone the repeater row
            repeaterRow.removeClass('repeater mt-repeater'); // Remove the repeater classes

            // Clear the input values in the cloned row
            repeaterRow.find('input[type="text"]').val('');

            $('#repeater-container').append(repeaterRow); // Append the cloned row to the container
        });
    });
</script> --><?php /**PATH D:\Laravel Projects\addonix\resources\views/lead/create.blade.php ENDPATH**/ ?>