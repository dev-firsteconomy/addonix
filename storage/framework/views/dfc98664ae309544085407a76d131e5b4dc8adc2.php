<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Order')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
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
                                    <th scope="col" class="sort" data-sort="name"> <?php echo e(__('Order Id')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Date')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Name')); ?></th>
                                    <th scope="col"><?php echo e(__('Plan Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"> <?php echo e(__('Price')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"> <?php echo e(__('Payment Type')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"> <?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"> <?php echo e(__('Coupon')); ?></th>
                                    <th scope="col" class="sort text-center" data-sort="completion"> <?php echo e(__('Invoice')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            
                                            <?php echo e($order->order_id); ?>

                                        </td>
                                        <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                        <td><?php echo e($order->user_name); ?></td>
                                        <td><?php echo e($order->plan_name); ?></td>
                                        <td><?php echo e(env('CURRENCY_SYMBOL').$order->price); ?></td>
                                        <td><?php echo e($order->payment_type); ?></td>

                                        <td>
                                            <?php if($order->payment_status == 'succeeded'): ?>
                                                <span class="d-flex align-items-center">
                                                    <i class="f-20 lh-1 ti ti-circle-check text-success"></i>
                                                    <span class="ms-1"><?php echo e(ucfirst($order->payment_status)); ?></span>
                                                </span>
                                            <?php else: ?>
                                                <span class="d-flex align-items-center">
                                                    <i class="f-20 lh-1 ti ti-circle-x text-danger"></i>
                                                    <span class="ms-1"><?php echo e(ucfirst($order->payment_status)); ?></span>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo e(!empty($order->total_coupon_used)? !empty($order->total_coupon_used->coupon_detail)?$order->total_coupon_used->coupon_detail->code:'-':'-'); ?></td>
                                        <td class="text-center">
                                            <?php if($order->receipt != 'free coupon' && $order->payment_type == 'STRIPE'): ?>
                                                <a href="<?php echo e($order->receipt); ?>" title="Invoice" target="_blank" class=""><i class="fas fa-file-invoice"></i> </a>
                                            <?php elseif($order->receipt =='free coupon'): ?>
                                                <p><?php echo e(__('Used 100 % discount coupon code.')); ?></p>
                                            <?php elseif($order->payment_type == 'Manually'): ?>
                                                <p><?php echo e(__('Manually plan upgraded by super admin')); ?></p>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\addonix\resources\views/order/index.blade.php ENDPATH**/ ?>