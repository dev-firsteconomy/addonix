<div class="row">
    <div class="col-lg-12">

        <div class="">
            <dl class="row">
                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('source')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->source); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Company Name')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->company_name); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Lead')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e(!empty($lead->lead_type_id) ? $lead->lead_type_id : '-'); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Company Address')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->company_address); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Contact No.')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->company_mobile); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Email')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->company_email); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Website')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->website); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Industry Vertical')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->industry_vertical); ?></span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('Assign User')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->assign_user_id); ?></span></dd>

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
                                <td><input name="name[]" class="form-control" type="text" value="<?php echo e($person->name); ?>" readonly/></td>
                                <td><input name="designation[]" class="form-control" type="text" value="<?php echo e($person->designation); ?>"  readonly/></td>
                                <td><input name="contact_number[]" class="form-control" type="tel"  value="<?php echo e($person->contact_number); ?>" readonly/></td>
                                <td><input name="email_id[]" class="form-control" type="email" value="<?php echo e($person->email_id); ?>"  readonly/></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- <tr class="repeater mt-repeater">
                                <th scope="col">2</th>
                                <td><input name="name[]" class="form-control" type="text" /></td>
                                <td><input name="designation[]" class="form-control" type="text" /></td>
                                <td><input name="contact_number[]" class="form-control" type="tel" /></td>
                                <td><input name="email_id[]" class="form-control" type="email" /></td>
                            </tr> -->
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
                                <td><input name="product_name[]" class="form-control" type="text" value="<?php echo e($product->product_name); ?>" readonly /></td>
                                <td><input name="serial_number[]" class="form-control" type="text" value="<?php echo e($product->serial_number); ?>" readonly /></td>
                                <td><input name="sub_start_date[]" class="form-control" type="date" value="<?php echo e($product->sub_start_date); ?>"  readonly /></td>
                                <td><input name="sub_end_date[]" class="form-control" type="date" value="<?php echo e($product->sub_end_date); ?>"  readonly /></td>
                                <td><input name="price[]" class="form-control" type="text" value="1000" style="width:120px" value="<?php echo e($product->price); ?>" readonly /></td>
                                <td><input name="sale_date[]" class="form-control" type="date" value="<?php echo e($product->sale_date); ?>"  readonly /></td>
                                <td><input name="created_by[]" class="form-control" type="text" value="<?php echo e($product->created_by); ?>"  readonly /></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            

                            <!-- <tr class="repeater mt-repeater">
                                <th scope="col">2</th>
                                <td><input name="product_name[]" class="form-control" type="text" /></td>
                                <td><input name="serial_number[]" class="form-control" type="text" /></td>
                                <td><input name="sub_start_date[]" class="form-control" type="date" /></td>
                                <td><input name="sub_end_date[]" class="form-control" type="date" /></td>
                                <td><input name="price[]" class="form-control" type="text" value="1000"
                                        style="width:120px" /></td>
                                <td><input name="sale_date[]" class="form-control" type="date" /></td>
                                <td><input name="created_by[]" class="form-control" type="text" /></td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Activities History Scroling</h5>
                </div>

                <dt class="col-md-4"><span class="h6 text-md mb-0"><?php echo e(__('source')); ?></span></dt>
                <dd class="col-md-8"><span class="text-md"><?php echo e($lead->source); ?></span></dd>


            </dl>
        </div>

        <div class="w-100 text-end pr-2">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
            <div class="action-btn bg-info ms-2">
                <a href="<?php echo e(route('lead.edit',$lead->id)); ?>"
                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"
                    data-title="<?php echo e(__('Lead Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div><?php /**PATH C:\xampp\htdocs\addonix\resources\views/lead/view.blade.php ENDPATH**/ ?>