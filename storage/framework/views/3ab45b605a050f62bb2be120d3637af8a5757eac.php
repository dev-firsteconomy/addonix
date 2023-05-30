<?php echo e(Form::open(array('url'=>'product','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status', $status, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <!-- <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('category',__('Category'),['class'=>'form-label'])); ?>

            <?php echo Form::select('category', $category, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('brand',__('Brand'),['class'=>'form-label'])); ?>

            <?php echo Form::select('brand', $brand, null,array('class' => 'form-control','required'=>'required')); ?>


        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('price',__('Price'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('price',null,array('class'=>'form-control','placeholder'=>__('Enter Price'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('tax', __('Tax'),['class'=>'form-label'])); ?>

            <?php echo Form::select('tax[]', $tax, null,array('class' => 'form-control select2','id'=>'choices-multiple','multiple')); ?>


            
        </div>
    </div> 
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('part_number',__('Part Number'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('part_number',null,array('class'=>'form-control','placeholder'=>__('Enter Part Number'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('weight',__('Weight'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('weight',null,array('class'=>'form-control','placeholder'=>__('Enter Weight')))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('URL',__('URL'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('URL',null,array('class'=>'form-control','placeholder'=>__('Enter URL'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'),['class'=>'form-label'])); ?>

            <?php echo Form::select('user', $user, null,array('class' => 'form-control')); ?>

        </div>
    </div>

     <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('SKU',__('SKU'),['class'=>'form-label'])); ?>

            <?php echo Form::text('sku',null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    -->
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary '))); ?>

    </div>
   
</div>
</div>
<?php echo e(Form::close()); ?>


<?php $__env->startPush('script-page'); ?>
<script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/select2/dist/js/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\addonix\resources\views/product/create.blade.php ENDPATH**/ ?>