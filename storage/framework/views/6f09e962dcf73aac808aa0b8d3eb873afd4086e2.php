
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Lead Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
        <div class="page-header-title">
           <?php echo e(__('Edit Lead')); ?> <?php echo e('('. $lead->company_name .')'); ?>

        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    
    <div class="btn-group" role="group">
        <?php if(!empty($previous)): ?>
        <div class="action-btn  ms-2">
            <a href="<?php echo e(route('lead.edit',$previous)); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('Previous')); ?>">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="<?php echo e(__('Previous')); ?>">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        <?php endif; ?>
        <?php if(!empty($next)): ?>
        <div class="action-btn  ms-2">
            <a href="<?php echo e(route('lead.edit',$next)); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('Next')); ?>">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="<?php echo e(__('Next')); ?>">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('lead.index')); ?>"><?php echo e(__('Lead')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            
            <!-- <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0"><?php echo e(__('Overview')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0"><?php echo e(__('Stream')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0"><?php echo e(__('Tasks')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div> -->
           
            <div class="col-xl-12">
                <?php if(Session::has('message')): ?>
                <div id="success-message" class="alert alert-success" role="alert" >
                    <?php echo e(Session::get('message')); ?>

                </div>
                <?php endif; ?>
                <div id="useradd-1" class="card">
                    <?php echo e(Form::model($lead,array('route' => array('lead.update', $lead->id), 'method' => 'PUT'))); ?>

                    <div class="card-header">
                        <h5><?php echo e(__('Overview')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit About Your Lead Information')); ?></small>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('company_name',__('comapny name'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter comapny name'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('lead_type_id',__(' Type'),['class'=>'form-label'])); ?>


                                        <?php
                                        $typeOptions = [
                                            ''=>'Select Lead Type',
                                            1 => 'Lead',
                                            2 => 'Opportunity',
                                            3 => 'Active Customer',
                                            4 => 'Non Active Customer',
                                        ];
                                        ?>

                                        <?php echo Form::select('lead_type_id',$typeOptions, $lead->lead_type_id,array('class' => 'form-control')); ?>

                                        <?php $__errorArgs = ['lead_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-lead_type_id" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('company_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_email" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('company_mobile',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['company_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-phone" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('website',__('Website'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('website',null,array('class'=>'form-control','placeholder'=>__('Enter Website'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-website" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('company_address',__('Lead Address'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('company_address',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Address'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_address" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                    <?php echo e(Form::label('industry', __('Industry'), ['class' => 'form-label'])); ?>

                                        <?php
                                        $industryOptions = [
                                            ''=>'Select industry Type',
                                            1 => 'industry 1',
                                            2 => 'industry 2',
                                        ];
                                        ?>
                                        <?php echo e(Form::select('industry_vertical', $industryOptions, $lead->industry_vertical, ['class' => 'form-control', 'required' => 'required'])); ?>


                                        <?php $__errorArgs = ['industry_vertical'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-industry_vertical" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    </div>
                                </div>

                               
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('user',__(' Assigned User'),['class'=>'form-label'])); ?>


                                        <?php
                                        $userOptions = [
                                            ''=>'Select User Type',
                                            1 => 'user 1',
                                            2 => 'user 2',
                                        ];
                                        ?>

                                        <?php echo Form::select('assign_user_id',$userOptions, $lead->assign_user_id,array('class' => 'form-control')); ?>

                                        <?php $__errorArgs = ['assign_user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-assign_user_id" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Persons</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Name</p>
                                </th>
                                <th>
                                    <p class="mb-0">Designation</p>
                                </th>
                                <th>
                                    <p class="mb-0">Contact Number</p>
                                </th>
                                <th>
                                    <p class="mb-0">Email Id</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1; ?>
                            <?php $__currentLoopData = $lead->industryPerson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="repeater mt-repeater">
                                <th scope="col"><?php echo e($i); ?></th>
                                <td><input name="name[]" class="form-control" type="text" value="<?php echo e($person->name); ?>"/></td>
                                <td><input name="designation[]" class="form-control" type="text" value="<?php echo e($person->designation); ?>" /></td>
                                <td><input name="contact_number[]" class="form-control" type="tel"  value="<?php echo e($person->contact_number); ?>"/></td>
                                <td><input name="email_id[]" class="form-control" type="email" value="<?php echo e($person->email_id); ?>" /></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Product</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">Product Name</p>
                                </th>
                                <th>
                                    <p class="mb-0">Serial Number</p>
                                </th>
                                <th>
                                    <p class="mb-0">Subscriptiion start date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Subscriptiion End date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Price</p>
                                </th>
                                <th>
                                    <p class="mb-0">Sale Date</p>
                                </th>
                                <th>
                                    <p class="mb-0">Created by</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1; ?>
                            <?php $__currentLoopData = $lead->industryProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="repeater mt-repeater">
                                <th scope="col"><?php echo e($i); ?></th>
                                <td><input name="product_name[]" class="form-control" type="text" value="<?php echo e($product->product_name); ?>"/></td>
                                <td><input name="serial_number[]" class="form-control" type="text" value="<?php echo e($product->serial_number); ?>"/></td>
                                <td><input name="sub_start_date[]" class="form-control" type="date" value="<?php echo e($product->sub_start_date); ?>" /></td>
                                <td><input name="sub_end_date[]" class="form-control" type="date" value="<?php echo e($product->sub_end_date); ?>" /></td>
                                <td><input name="price[]" class="form-control" type="text" style="width:120px" value="<?php echo e($product->price); ?>"/></td>
                                <td><input name="sale_date[]" class="form-control" type="date" value="<?php echo e($product->sale_date); ?>" /></td>
                                <td><input name="created_by[]" class="form-control" type="text" value="<?php echo e($product->created_by); ?>" /></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Activities History Scroling</h5>
                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('activity ',__(' Activities'),['class'=>'form-label'])); ?>


                                        <?php
                                        $activitiesOptions = [
                                            ''=>'Select Activity Type',
                                            1 => 'activity  1',
                                            2 => 'activity 2',
                                        ];
                                        ?>

                                        <?php echo Form::select('activities',$activitiesOptions, $lead->activities,array('class' => 'form-control')); ?>

                                        <?php $__errorArgs = ['activities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-activities" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                
                                <div class="text-end">
                                    <?php echo e(Form::submit(__('Update'),array('class'=>'btn-submit btn btn-primary'))); ?>

                                </div>


                            </div>
                        </form>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>    
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000); // Hide the message after 5 seconds (adjust the timeout value as needed)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addonix\resources\views/lead/edit.blade.php ENDPATH**/ ?>