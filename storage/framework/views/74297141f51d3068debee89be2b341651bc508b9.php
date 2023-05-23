<?php
    $dir= asset(Storage::url('uploads/plan'));
    $settings = Utility::settings();
?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

    <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="action-btn ms-2">
            <a href="#" data-url="<?php echo e(route('plan.create')); ?>" data-size="md" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Plan')); ?>"title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
            <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
               visibility: visible;
               animation-delay: 0.2s;
               animation-name: fadeInUp;
               ">
                <div class="card-body <?php echo e(!empty(\Auth::user()->type != 'super admin')?'plan-box':''); ?>" style="height: 362px;">
                    <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>
                    <?php if( \Auth::user()->type == 'super admin'): ?>
                    <div class="d-flex flex-row-reverse m-0 p-0 ">
                        <div class="action-btn bg-primary ms-2">
                            <a title="Edit Plan" data-size="md" href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-url="<?php echo e(route('plan.edit',$plan->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i></a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(\Auth::user()->type == 'owner' && \Auth::user()->plan == $plan->id): ?>
                        <div class="d-flex flex-row-reverse m-0 p-0 ">
                            <span class="d-flex align-items-center ">
                                <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                <span class="ms-2"><?php echo e(__('Active')); ?></span>
                            </span>
                        </div>
                    <?php endif; ?>

                    <h1 class="mb-4 f-w-600 "><?php echo e(( $settings['site_currency_symbol'] ? env('CURRENCY_SYMBOL') : '$')); ?><?php echo e(number_format($plan->price)); ?><small class="text-sm">/<?php echo e(env('CURRENCY_SYMBOL').__(\App\Models\Plan::$arrDuration[$plan->duration])); ?></small></h1>
                    
                    <p class="my-4"><?php echo e($plan->description); ?></p>

                    <ul class="list-unstyled">
                        <li> <span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->max_user); ?> <?php echo e(__('Users')); ?></li>
                        <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->max_account); ?> <?php echo e(__('Account')); ?></li>
                        <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->max_contact); ?> <?php echo e(__('Contact')); ?></li>
                    </ul>
                    <br>


                    <div class=" row ">
                        <div class="col-8">

                            <?php if($plan->id != \Auth::user()->plan && \Auth::user()->type != 'super admin'): ?>
                                <?php if($plan->price > 0): ?>
                                    
                                    <a href="<?php echo e(route('plan.payment', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                        id="interested_plan_2"
                                        class="btn btn-primary d-flex justify-content-center align-items-center">
                                        <i class="ti ti-shopping-cart m-1 text-white"></i><?php echo e(__('Subscribe')); ?>

                                    </a>
                                    
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-4">

                            <?php if(\Auth::user()->type != 'super admin' && \Auth::user()->plan != $plan->id): ?>
                                <?php if($plan->id != 1): ?>

                                    <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                        <a href="<?php echo e(route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>"
                                            class="btn btn-primary btn-icon m-1" data-title="<?php echo e(__('Send Request')); ?>"
                                            title="<?php echo e(__('Send Request')); ?>" data-bs-toggle="tooltip">
                                            <span class="btn-inner--icon"><i class="ti ti-corner-up-right"></i></span>

                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('request.cancel', \Auth::user()->id)); ?>"
                                            class="btn btn-danger btn-icon m-1" data-title="<?php echo e(__('Cancle Request')); ?>"
                                            title="<?php echo e(__('Cancle Request')); ?>" data-bs-toggle="tooltip">
                                            <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                        </a>
                                    <?php endif; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>


                    <?php if(\Auth::user()->type=='owner' && \Auth::user()->plan == $plan->id): ?>
                        <p class="server-plan ">
                            <?php echo e(__('Expired : ')); ?> <?php echo e(\Auth::user()->plan_expire_date ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date):__('lifetime')); ?>

                        </p>
                    <?php endif; ?>
              </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\addonix\resources\views/plan/index.blade.php ENDPATH**/ ?>