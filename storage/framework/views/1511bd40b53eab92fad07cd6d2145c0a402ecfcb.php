
    <?php echo e(Form::model($formBuilder, array('route' => array('form_builder.update', $formBuilder->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required' => 'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('active', __('Active'),['class'=>'form-label'])); ?>

            <div class="d-flex radio-check">
                <div class="form-check">
                    <input type="radio" id="on" value="1" name="is_active" class="form-check-input" <?php echo e(($formBuilder->is_active == 1) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="on"><?php echo e(__('On')); ?></label>
                </div>
                <div class="form-check ms-3">
                    <input type="radio" id="off" value="0" name="is_active" class="form-check-input" <?php echo e(($formBuilder->is_active == 0) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="off"><?php echo e(__('Off')); ?></label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn  btn-light"
                data-bs-dismiss="modal">Close</button>
                <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary '))); ?>

        </div>
    </div>
    <?php echo e(Form::close()); ?>


<?php /**PATH D:\projects\addonix\resources\views/form_builder/edit.blade.php ENDPATH**/ ?>