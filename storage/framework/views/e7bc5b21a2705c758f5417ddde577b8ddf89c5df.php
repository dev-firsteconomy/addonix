<?php echo e(Form::open(array('route' => ['form.field.store',$formbuilder->id]))); ?>

<div class="row" id="frm_field_data">
    <div class="col-12 form-group">
        <?php echo e(Form::label('name', __('Question Name'),['class'=>'form-label'])); ?>

        <?php echo e(Form::text('name[]', '', array('class' => 'form-control','required'=>'required','placeholder'=>'Question Name'))); ?>

    </div>
    <div class="col-13 form-group">
        <?php echo e(Form::label('type', __('Type'),['class'=>'form-label'])); ?>

        <?php echo e(Form::select('type[]', $types,null, array('class' => 'form-control','required'=>'required'))); ?>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary '))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\projects\addonix\resources\views/form_builder/field_create.blade.php ENDPATH**/ ?>