<div class="row">
    <div class="col-lg-12">

            <div class="">
                <dl class="row">
                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Name')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e($product->name); ?></span></dd>


                    <!-- <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Status')); ?></span></dt>
                    <dd class="col-md-7">
                        <?php if($product->status == 0): ?>
                            <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Product::$status[$product->status])); ?></span>
                        <?php elseif($product->status == 1): ?>
                            <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Product::$status[$product->status])); ?></span>
                        <?php endif; ?>
                    </dd> -->

                    <!-- <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Category')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e(!empty($product->categorys)?$product->categorys->name:'-'); ?></span></dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Brand')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e(!empty($product->Brands)?$product->Brands->name:'-'); ?></span></dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Price')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e(\Auth::user()->priceFormat($product->price)); ?></span></dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Tax')); ?></span></dt>
                    <dd class="col-md-7">
                        <span class="text-md">

                            <?php $__currentLoopData = $product->tax($product->tax); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tax1">
                                    <?php if(!empty($tax)): ?>
                                        <h6>
                                            <span class="badge bg-primary p-2 px-3 rounded"><?php echo e($tax->tax_name .' ('.$tax->rate.' %)'); ?></span>
                                        </h6>
                                    <?php else: ?>
                                        <h6>
                                            <span class="badge bg-primary p-2 px-3 rounded"><?php echo e(__('No Tax')); ?></span>
                                        </h6>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                    </dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Part Number')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e($product->part_number); ?></span></dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Weight')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e($product->weight); ?></span></dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('URL')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e($product->URL); ?></span></dd>


                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Description')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e($product->description); ?></span></dd>

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Assigned User')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e(!empty($product->assign_user)?$product->assign_user->name:'-'); ?></span></dd> -->

                    <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Created')); ?></span></dt>
                    <dd class="col-md-7"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($product->created_at)); ?></span></dd>

                </dl>
            </div>

    </div>
    <div class="w-100 text-end pr-2">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Product')): ?>
        <div class="action-btn bg-info ms-2">
            <a href="<?php echo e(route('product.edit',$product->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"data-title="<?php echo e(__('product Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i>
        </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\addonix\resources\views/product/view.blade.php ENDPATH**/ ?>