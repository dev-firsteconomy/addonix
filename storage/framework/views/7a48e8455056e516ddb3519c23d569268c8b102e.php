

<?php $__env->startSection('page-title'); ?>
    <?php echo e($formBuilder->name.__("'s Form Field")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
        <?php echo e($formBuilder->name.__("'s Form Field")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('form_builder.index')); ?>"><?php echo e(__('Form Builder')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Add Field')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Form Field')): ?>
        <div class="action-btn ms-2">
            <a href="#" data-size='md' data-url="<?php echo e(route('form.field.create',$formBuilder->id)); ?>" data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create New Filed')); ?>" title="<?php echo e(__('Create ')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <?php if(\Auth::user()->can('Edit Form Field') || \Auth::user()->can('Delete Form Field')): ?>
                                    <th class="text-end" width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($formBuilder->form_field->count()): ?>
                                <?php $__currentLoopData = $formBuilder->form_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($field->name); ?></td>
                                        <td><?php echo e(ucfirst($field->type)); ?></td>
                                        <?php if(\Auth::user()->can('Edit Form Field') || \Auth::user()->can('Delete Form Field')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Form Field')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-size="md"data-url="<?php echo e(route('form.field.edit',[$formBuilder->id,$field->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Field')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Form Field')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['form.field.destroy', [$formBuilder->id,$field->id]]]); ?>

                                                            <a href="#!" class="mx-3 btn btn-sm   align-items-center text-white show_confirm"  data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel Projects\addonix\resources\views/form_builder/show.blade.php ENDPATH**/ ?>