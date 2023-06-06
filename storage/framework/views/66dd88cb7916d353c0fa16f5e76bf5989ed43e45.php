
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Lead')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Lead')); ?>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Lead')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<!-- <a href="<?php echo e(route('lead.grid')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('Kanban View')); ?>">
    <i class="ti ti-layout-kanban"></i>
</a> -->

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Lead')): ?>
<a href="#" data-url="<?php echo e(route('lead.create',['lead',0])); ?>" data-size="lg" data-ajax-popup="true"
    data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Lead')); ?>" title="<?php echo e(__('Create')); ?>"
    class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<form action="leadSearch" method="get">
<div class="row">
        <div class="col-lg-3">
            <div class="input-group mb-3">
            <span class="input-group-text">From Date:</span>
            <input type="date" name="fromDate" class="form-control" value="<?php echo isset($_REQUEST['fromDate']) ? $_REQUEST['fromDate'] : ''; ?>" >
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group mb-3">
            <span class="input-group-text">To Date:</span>
            <input type="date" name="toDate" class="form-control" value="<?php echo isset($_REQUEST['toDate']) ? $_REQUEST['toDate'] : ''; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group mb-3">
            <span class="input-group-text">Filter status Wise:</span>
            <select class="form-select" aria-label="Default select example" name="leadType">
                <option value="">Select...</option>
                <option value="lead" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'lead' ? 'selected' : ''); ?>>lead</option>
                <option value="Opportunity" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Opportunity' ? 'selected' : ''); ?> >Opportunity</option>
                <option value="Active Customer" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Active Customer' ? 'selected' : ''); ?>>Active Customer</option>
                <option value="Non Active Customer" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Non Active Customer' ? 'selected' : ''); ?>>Non Active Customer</option>
            </select>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="input-group mb-3">  
                <button class="btn btn-primary" type="submit" id="leadSearchBtn">Search!</button>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="input-group mb-3">  
                <a href="/lead" class="btn btn-primary">Reset</a>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Company Name')); ?></th>
                                <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Lead Type')); ?></th>
                                <!-- <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Company Address')); ?></th> -->
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Company Contact No.')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Email')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Website')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Industry Vertical')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Lead Owner')); ?></th>
                                <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead')): ?>
                                <th scope="col" class="text-start
                                "><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
      
                        <tbody>
                            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <!-- <td>
                                    <a href="#" data-size="md" data-url="<?php echo e(route('lead.show',$lead->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Lead Details')); ?>" class="action-item text-primary">
                                        <?php echo e(ucfirst($lead->name)); ?>

                                    </a>
                                </td> -->
                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->company_name) ? $lead->company_name:'--')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->lead_type_id) ? $lead->lead_type_id:'--')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(!empty($lead->company_mobile) ? $lead->company_mobile:'--'); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->company_email) ? $lead->company_email:'--')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->website) ? $lead->website:'--')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->industry_vertical) ? $lead->industry_vertical:'--')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->assign_user_id) ? $lead->assign_user_id:'--')); ?></span>
                                </td>

                                <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead')): ?>
                                    <td class="text-end">
                                        <div class="action-btn bg-dark ms-2">
                                            <a href="#" data-size="lg" data-url="<?php echo e(route('addInteration',$lead->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('interation')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('add Interation')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-dark ms-2">
                                            <a href="#" data-size="lg" data-url="<?php echo e(route('changeStatus',$lead->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Change Status')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('change status')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="#" data-size="lg" data-url="<?php echo e(route('lead.show',$lead->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Lead Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip"title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Lead')); ?>"><i class="ti ti-edit"></i></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Lead')): ?>
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]); ?>

                                        <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
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

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\addonix\resources\views/lead/index.blade.php ENDPATH**/ ?>