<?php echo e(Form::open(array('url'=>'account_type','method'=>'post'))); ?>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Account Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Account Type'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Save'),array('class'=>'btn  btn-primary '))); ?><?php echo e(Form::close()); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\Laravel Projects\addonix\resources\views/account_type/create.blade.php ENDPATH**/ ?>