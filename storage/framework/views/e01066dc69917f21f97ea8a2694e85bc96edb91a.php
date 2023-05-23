<?php echo e(Form::model($formField, array('route' => array('form.bind.store', $form->id)))); ?>

<div class="row">
    <div class="col-12 pb-3">
        <span class="text-xs"><b><?php echo e(__('It will auto convert from response on lead or account or contact based on below setting. It will not convert old response.')); ?></b></span>
    </div>
</div>


<div class="row px-2">
    <div class="col-4">
        <div class="form-group">
            <?php echo e(Form::label('active', __('Lead Active'),['class'=>'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-8">
        <div class="d-flex radio-check">
            <div class="form-check">
                <input type="radio" id="lead_on" value="1" name="is_lead_active" class="form-check-input radio" <?php echo e(($form->is_lead_active == 1) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="lead_on"><?php echo e(__('On')); ?></label>
            </div>
            <div class="form-check ms-3">
                <input type="radio" id="lead_off" value="0" name="is_lead_active" class="form-check-input radio" <?php echo e(($form->is_lead_active == 0) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="lead_off"><?php echo e(__('Off')); ?></label>
            </div>
        </div>
    </div>
</div>
<div class="row px-2">
    <div class="col-4">
        <div class="form-group">
            <?php echo e(Form::label('active', __('Account Active'),['class'=>'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-8">
        <div class="d-flex radio-check">
            <div class="form-check">
                <input type="radio" id="account_on" value="1" name="is_account_active" class="form-check-input radio" <?php echo e(($form->is_account_active == 1) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="account_on"><?php echo e(__('On')); ?></label>
            </div>
            <div class="form-check ms-3">
                <input type="radio" id="account_off" value="0" name="is_account_active" class="form-check-input radio" <?php echo e(($form->is_account_active == 0) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="account_off"><?php echo e(__('Off')); ?></label>
            </div>
        </div>
    </div>
</div>
<div class="row px-2">
    <div class="col-4">
        <div class="form-group">
            <?php echo e(Form::label('active', __('Contact Active'),['class'=>'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-8">
        <div class="d-flex radio-check">
            <div class="form-check">
                <input type="radio" id="contact_on" value="1" name="is_contact_active" class="form-check-input radio" <?php echo e(($form->is_contact_active == 1) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="contact_on"><?php echo e(__('On')); ?></label>
            </div>
            <div class="form-check ms-3">
                <input type="radio" id="contact_off" value="0" name="is_contact_active" class="form-check-input radio" <?php echo e(($form->is_contact_active == 0) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="contact_off"><?php echo e(__('Off')); ?></label>
            </div>
        </div>
    </div>
</div>

<div id="lead_activated" class="d-none mt-4">
    <div class="row px-2">
        <div class="col-4">
            <div class="form-group">
                <?php echo e(Form::label('name_id', __('Name'),['class'=>'form-label'])); ?>

            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('name_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>

        <div class="col-4">
            <?php echo e(Form::label('email_id', __('Email'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('email_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('phone_id', __('Phone'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('phone_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('address_id', __('Address'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('address_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('city_id', __('City'),['class'=>'form-control-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('city_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('state_id', __('State'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('state_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('country_id', __('Country'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('country_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('postal_code', __('Postal Code'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('postal_code', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('description_id', __('Description'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('description_id', $types,null, array('class' => 'form-control'))); ?>

            </div>
        </div>

        <div class="col-4">
            <?php echo e(Form::label('user_id', __('User'),['class'=>'form-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control'))); ?>

            </div>
        </div>
    </div>
</div>

<?php echo e(Form::hidden('form_id',$form->id)); ?>

<?php echo e(Form::hidden('form_response_id',(!empty($formField)) ? $formField->id : '')); ?>


<div class="row">
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>



<script>
    $(document).ready(function () {
        var lead_active = <?php echo e($form->is_lead_active); ?>;
        var account_active = <?php echo e($form->is_account_active); ?>;
        var contact_active = <?php echo e($form->is_contact_active); ?>;

        if (lead_active == 1 || account_active == 1 || contact_active == 1) {
            $('#lead_activated').removeClass('d-none');
        }
    });
    $(document).on('click', function () {
        $('.radio').on('click', function () {
            var inputValue = $(this).attr("value");
            if (inputValue == 1) {
                $('#lead_activated').removeClass('d-none');
            } else {
                $('#lead_activated').addClass('d-none');
            }
            $('.radio').removeAttr('checked');
            $(this).prop("checked", true);
        })
    });
</script>
<?php /**PATH D:\projects\addonix\resources\views/form_builder/form_field.blade.php ENDPATH**/ ?>