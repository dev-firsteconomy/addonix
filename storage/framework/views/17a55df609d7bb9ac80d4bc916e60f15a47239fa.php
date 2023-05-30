
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<!-- <div class="action-btn ms-2">
    <a href="<?php echo e(route('product.grid')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
        title="<?php echo e(__('Grid View')); ?>">
        <i class="ti ti-layout-grid text-white"></i>
    </a>
</div>

    <div class="action-btn ms-2">
        <a href="<?php echo e(route('product.export')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
            title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>
    </div>

    <div class="action-btn ms-2">
        <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-url="<?php echo e(route('product.file.import')); ?>"
            data-ajax-popup="true" data-title="<?php echo e(__('Import Product CSV File')); ?>" data-bs-toggle="tooltip"
            title=" <?php echo e(__('Import')); ?>">
            <i class="ti ti-file-import"></i>
        </a>
    </div> -->

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Product')): ?>
        <div class="action-btn ms-2">
            <a href="#" data-url="<?php echo e(route('product.create', ['product', 0])); ?>" data-size="lg" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Product')); ?>" title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive overflow_hidden">
                            <table id="datatable" class="table datatable align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                        <!-- <th scope="col" class="sort" data-sort="Brand"><?php echo e(__('Brand')); ?></th> -->
                                        <!-- <th scope="col" class="sort" data-sort="Status"><?php echo e(__('Status')); ?></th> -->
                                        <!-- <th scope="col" class="sort" data-sort="Price"><?php echo e(__('Price')); ?></th> -->
                                        <!-- <th scope="col" class="sort" data-sort="assign User">
                                            <?php echo e(__('assign User')); ?></th>
                                        <th scope="col" class="sort" data-sort="barcode"><?php echo e(__('BarCode')); ?></th>-->
                                        <?php if(Gate::check('Show Product') || Gate::check('Edit Product') || Gate::check('Delete Product')): ?>
                                            <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                        <?php endif; ?> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md"
                                                    data-url="<?php echo e(route('product.show', $product->id)); ?>"
                                                    data-ajax-popup="true" data-title="<?php echo e(__('Product Details')); ?>"
                                                    class="action-item text-primary">
                                                    <?php echo e(ucfirst($product->name)); ?>

                                                </a>
                                            </td>
                                            <!-- <td>
                                                <span class="budget"><?php echo e(ucfirst(!empty($product->brands->name) ? $product->brands->name : '-')); ?>

                                                </span>
                                            </td> -->
                                            
                                            <?php if(Gate::check('Show Product') || Gate::check('Edit Product') || Gate::check('Delete Product')): ?>
                                                <td class="text-end">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Product')): ?>
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" data-size="md"
                                                                data-url="<?php echo e(route('product.show', $product->id)); ?>"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Product Details')); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Product')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(route('product.edit', $product->id)); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                data-title="<?php echo e(__('Edit Product')); ?>"><i
                                                                    class="ti ti-edit"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Product')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id]]); ?>

                                                            <a href="#!"
                                                                class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>

                                                        
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addonix\resources\views/product/index.blade.php ENDPATH**/ ?>