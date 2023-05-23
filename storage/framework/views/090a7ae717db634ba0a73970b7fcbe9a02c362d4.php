<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Opportunities')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
        <?php echo e(__('Opportunities')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Opportunities')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <a href="<?php echo e(route('opportunities.grid')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('Kanban View')); ?>">
        <i class="ti ti-layout-kanban"></i>
    </a> 
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Opportunities')): ?>
            <a href="#" data-url="<?php echo e(route('opportunities.create',['opportunities',0])); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Opportunities')); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
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
                                        <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Stage')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Assigned User')); ?></th>
                                        <?php if(Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities')): ?>
                                            <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $opportunitiess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="<?php echo e(route('opportunities.show', $opportunities->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Opportunities Details')); ?>" class="action-item text-primary">
                                                    <?php echo e(ucfirst($opportunities->name)); ?>

                                                </a>
                                            </td>
                                            <td >
                                                <span class="budget"><?php echo e(ucfirst(!empty($opportunities->accounts)?$opportunities->accounts->name:'-')); ?></span>
                                            </td>
                                            <td>
                                                <span class="budget">
                                                    <?php echo e(ucfirst(!empty($opportunities->stages)?$opportunities->stages->name:'-')); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e(\Auth::user()->priceFormat($opportunities->amount)); ?></span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e(ucfirst(!empty($opportunities->assign_user)?$opportunities->assign_user->name:'-')); ?></span>
                                            </td>
                                            <?php if(Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities')): ?>
                                                <td class="text-end">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Opportunities')): ?>
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" data-size="md" data-url="<?php echo e(route('opportunities.show',$opportunities->id)); ?>" data-bs-toggle="tooltip"title="<?php echo e(__('Details')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('opportunities Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Opportunities')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(route('opportunities.edit',$opportunities->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Opportunities Edit')); ?>"><i class="ti ti-edit"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Opportunities')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['opportunities.destroy', $opportunities->id]]); ?>

                                                                <a href="#!" class="mx-3 btn btn-sm   align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\addonix\resources\views/opportunities/index.blade.php ENDPATH**/ ?>