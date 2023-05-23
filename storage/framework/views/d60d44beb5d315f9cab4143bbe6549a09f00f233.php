<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User Logs')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Users Logs')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(url('user')); ?>"><?php echo e(__('User')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('User Logs')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['url' => ['userlog'], 'method' => 'get', 'id' => 'userlogs_filter'])); ?>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <?php echo e(Form::month('month', isset($_GET['month']) ? $_GET['month'] : '', ['class' => 'form-control'])); ?>

                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <?php echo e(Form::select('user', $usersList, isset($_GET['users']) ? $_GET['users'] : '', ['class' => 'form-control select ', 'id' => 'id'])); ?>

                        </div>
                        <div class="action-btn bg-primary col-auto float-end">
                            <button type="submit" class="m-1 btn btn-sm align-items-center text-white"
                                onclick="document.getElementById('userlogs_filter').submit(); return false;"
                                data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-title="<?php echo e(__('Apply')); ?>"><i
                                    class="ti ti-search"></i></button>
                        </div>
                        <div class="action-btn bg-danger col-auto float-end" style="margin-left:5px">
                            <a href="<?php echo e(url('userlog')); ?>" data-bs-toggle="tooltip"
                                title="<?php echo e(__('Reset')); ?>"data-title="<?php echo e(__('Reset')); ?>"
                                class="mx-3 btn btn-sm align-items-center text-white"><i class="ti ti-trash-off"></i></a>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>

            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table align-items-center datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(__('User Name')); ?></th>
                                    <th><?php echo e(__('Role')); ?></th>
                                    <th><?php echo e(__('IP')); ?></th>
                                    <th><?php echo e(__('Last Login At')); ?></th>
                                    <th><?php echo e(__('Country')); ?></th>
                                    <th><?php echo e(__('Device Type')); ?></th>
                                    <th><?php echo e(__('Os Name')); ?></th>
                                    <th><?php echo e(__('Details')); ?></th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <?php
                                        $json = json_decode($user->details);
                                        $userType = App\Models\User::find($user->id);

                                    ?>
                                    <td><?php echo e($user->user_name); ?></td>
                                    <td> <span class="me-5 badge p-2 px-3 rounded bg-success"><?php echo e($userType->type); ?></span></td>
                                    <td><?php echo e($user->ip); ?></td>
                                    <td><?php echo e($user->date); ?></td>
                                    <td><?php echo e($json->country); ?></td>
                                    <td><?php echo e($json->device_type); ?></td>
                                    <td><?php echo e($json->os_name); ?></td>
                                    <td>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="#" data-size="md"
                                                data-url="<?php echo e(route('userlog.view', $user->id)); ?>" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('View')); ?>" data-ajax-popup="true"
                                                data-title="<?php echo e(__('View User Logs')); ?>"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['userlog.destroy', $user->id]]); ?>

                                            <a href="#!" class="mx-3 btn btn-sm align-items-center show_confirm ">
                                                <i class="ti ti-trash text-white" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Delete')); ?>"></i>
                                            </a>
                                            <?php echo Form::close(); ?>

                                        </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\addonix\resources\views/userlog/index.blade.php ENDPATH**/ ?>