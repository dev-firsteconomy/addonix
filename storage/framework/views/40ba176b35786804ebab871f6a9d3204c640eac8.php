

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Lead Create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Create Lead')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
<div class="btn-group" role="group">
    <div class="action-btn  ms-2">
        <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
            Back
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('lead.index')); ?>"><?php echo e(__('Lead')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Create')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Source',__('Source'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('source',[''=>'Select source','Referral'=>'Referral','Digital'=>'Digital','Offline'=>'Offline','Other'=>'Other'],null,array('class'=>'form-control'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Company Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('parent_company_name',__('Parent Company Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('parent_company_name',null,array('class'=>'form-control','placeholder'=>__('Parent Company Name')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_address',__('Company Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('lead_address',null,array('class'=>'form-control','placeholder'=>__('Company Address'),'rows'=>'1','cols'=>'10'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('phone',__('Contact No.'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required', 'maxLength'=>'10'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('website',__('Website'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('website',null,array('class'=>'form-control','placeholder'=>__('Enter Website')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('existing_customer',__('Existing Customer'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('existing_customer', [
                    '' => 'Select Option',
                    'Yes' => 'Yes',
                    'No' => 'No'
                ], 'existing_customer', ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('type',__('Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('type', [
                    'Lead' => 'Lead',
                    'Opportunity' => 'Opportunity',
                    'Active Customer' => 'Active Customer',
                    'Non Active Customer' => 'Non Active Customer',
                    'Dead' => 'Dead'
                ], 'lead', ['class' => 'form-control', 'disabled' => 'disabled'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('met_or_spoke',__('Met Or Spoke to Person'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('met_or_spoke', [
                    '' => 'Select Option',
                    'MEET IN PERSON' => 'MEET IN PERSON',
                    'CALL' => 'CALL'
                ], 'met_or_spoke', ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('is_mnc',__('If an MNC'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('is_mnc', [
                    '' => 'Select Option',
                    'Yes' => 'Yes',
                    'No' => 'No'
                ], 'is_mnc', ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('industry_vertical',__('Industry Vertical'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('industry_vertical',[''=>'Select Industry Vertical','Machining'=>'Machining',
                'Manufacturing'=>'Manufacturing','Aerospace'=>'Aerospace','Transportation & Automotive'=>'Transportation & Automotive',
                'Oil & Gas'=>'Oil & Gas','Safety'=>'Safety','Construction'=>'Construction' , 'Utilities'=>'Utilities','Government and Military Entities'=>'Government and Military Entities'
                ],null,array('class'=>'form-control'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
                <?php echo e(Form::label('create_date',__('Creation Date'),['class'=>'form-label'])); ?>

                <input type="date" name="create_date" class="form-control">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
                <?php echo e(Form::label('estimated_close_date',__('Estimated Closed Date'),['class'=>'form-label'])); ?>

                <input type="date" name="estimated_close_date" class="form-control">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('assign_user_id',__('Lead Owner'),['class'=>'form-label'])); ?>

            <?php echo Form::select('assign_user_id', $user, null,array('class' => 'form-control')); ?>

        </div>
    </div>

    <div class="col-12">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Point Of Contact</h3>
        </div>
    </div>
    <div id="poc-repeater-container">
        <div class="col-12 table-responsive">
            <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                <thead>
                    <tr>
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
                    <tr class="poc-repeater mt-repeater">
                        <td><input name="poc_name[]" class="form-control poc_inputs" type="text" required /></td>
                        <td><input name="poc_designation[]" class="form-control poc_inputs" type="text" required /></td>
                        <td><input name="poc_contact_number[]" class="form-control poc_inputs" type="tel" maxLength ="10" required /></td>
                        <td><input name="poc_email_id[]" class="form-control poc_inputs" type="email" required /></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="pull-right text-center">
                <button class="btn btn-primary" type="button" id="poc-add-field"><i class="ti ti-plus"></i></button>
                <button class="btn btn-danger" type="button" id="poc-remove-field"><i class="ti ti-minus"></i></button>
            </div>
        </div>
    </div>

    <!-- <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Product</h3>
        </div>
    </div>
    <div class="col-12">
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
                        <?php echo e(Form::select('product_name[]', $products,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>''))); ?>

                    </td>
                </tr>
            </tbody>
        </table>
    </div> -->

    <!-- <div class="col-12 mt-4">
        <div class="form-heading">
            <h3 style="font-weight: 600;font-size: 18px;">Interaction Activity</h3>
        </div>
    </div>

    <div id="interaction-repeater-container">
        <table class="table">
            <tbody>
                <tr class="interaction-repeater mt-repeater">
                    <td>
                        <div class="form-group">
                            <?php echo e(Form::label('interaction_date', __('Interaction Date'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::date('interaction_date[]', null, ['class' => 'form-control interaction_inputs'])); ?>

                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo e(Form::label('interaction_activity_type', __('Interaction Activity Type'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::select('interaction_activity_type[]', ['' => 'Select Activities Type', 'Call' => 'Call', 'Meeting' => 'Meeting', 'Opportunity' => 'Opportunity', 'Demo' => 'Demo', 'Quotation' => 'Quotation', 'MOM' => 'MOM', 'PI' => 'PI'], null, ['class' => 'form-control interaction_inputs'])); ?>

                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo e(Form::label('interaction_feedback', __('Interaction Feedback'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::text('interaction_feedback[]', null, ['class' => 'form-control interaction_inputs', 'placeholder' => __('Enter Feedback')])); ?>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pull-right text-center">
            <button class="btn btn-primary" type="button" id="interaction-add-field"><i class="ti ti-plus"></i></button>
            <button class="btn btn-danger" type="button" id="interaction-remove-field"><i class="ti ti-minus"></i></button>
        </div>
    </div> -->

    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script>
    document.getElementById('poc-add-field').addEventListener('click', function() {
        const container = document.getElementById('poc-repeater-container');
        const lastRow = container.querySelector('.poc-repeater:last-of-type');
        const newRow = lastRow.cloneNode(true);
        const inputs = newRow.querySelectorAll('.poc_inputs');

        // Clear input field values in the new row
        inputs.forEach(input => {
            input.value = '';
        });

        container.querySelector('tbody').appendChild(newRow);
    });

    // Remove row
    var removeButton = document.getElementById('poc-remove-field');
    var repeaterContainer = document.getElementById('poc-repeater-container');
    removeButton.addEventListener('click', function() {
        var repeaterRows = repeaterContainer.querySelectorAll('.poc-repeater');
        if (repeaterRows.length > 1) {
            var lastRow = repeaterRows[repeaterRows.length - 1];
            lastRow.parentNode.removeChild(lastRow);
        }
    });

    // document.getElementById('interaction-add-field').addEventListener('click', function() {
    //     const container1 = document.getElementById('interaction-repeater-container');
    //     const lastRow1 = container1.querySelector('.interaction-repeater:last-of-type');
    //     const newRow1 = lastRow1.cloneNode(true);
    //     const inputs1 = newRow1.querySelectorAll('.interaction_inputs');

    //     // Clear input field values in the new row
    //     inputs1.forEach(input => {
    //         input.value = '';
    //     });

    //     container1.querySelector('tbody').appendChild(newRow1);
    // });

    // // Remove row
    // var removeButton1 = document.getElementById('interaction-remove-field');
    // var repeaterContainer1 = document.getElementById('interaction-repeater-container');
    // removeButton1.addEventListener('click', function() {
    //     var repeaterRows1 = repeaterContainer1.querySelectorAll('.interaction-repeater');
    //     if (repeaterRows1.length > 1) {
    //         var lastRow1 = repeaterRows1[repeaterRows1.length - 1];
    //         lastRow1.parentNode.removeChild(lastRow1);
    //     }
    // });

    //AUTOCOMPLETE
    $(document).ready(function() {
        $('#company_name').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/companies/search",
                    type: "GET",
                    dataType:"json",
                    data: {
                        term: $('#company_name').val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2
        });
    });
    //AUTOCOMPLETE
</script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\addonix\resources\views/lead/create.blade.php ENDPATH**/ ?>