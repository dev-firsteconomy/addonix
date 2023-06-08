
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Lead')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>

<!-- <style>

.datatable .dropdown-toggle::after {
    display: none;
}

.radioForm input {
    padding: 6px 10px;
    display: inline-block;
    border: 1px solid grey;
    cursor: pointer;
    border-radius: 4px;
    min-width: 110px;
    height: 42px;
    box-sizing: border-box;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    text-transform: capitalize;
}

.radioForm  label {
    display: none;
}

.radioForm.active  input {
    background: #2bdc52;
    color: #fff;
    border-color: #2bdc52;
}

</style> -->
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
            <input type="date" name="fromDate" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group mb-3">
            <span class="input-group-text">To Date:</span>
            <input type="date" name="toDate" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group mb-3">
            <span class="input-group-text">Filter status Wise:</span>
            <select class="form-select" aria-label="Default select example" name="leadType">
                <option value="">Select...</option>
                <option value="Lead" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Lead' ? 'selected' : ''); ?>>Lead</option>
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
<?php if(Session::has('success')): ?>
<div id="success-message" class="alert alert-success" role="alert" >
    <?php echo e(Session::get('message')); ?>

</div>
<?php endif; ?>
<?php if(Session::has('error')): ?>
<div id="error-message" class="alert alert-error" role="alert" >
    <?php echo e(Session::get('message')); ?>

</div>
<?php endif; ?>
<!-- radioForm -->
<!-- <div class="radioFormWrapper d-flex gap-2">
    <form action="LeadTab" class="radioForm active" method="get">
        <input type="text" id="lead" name="type" value="Lead" readonly checked />
        <label for="lead">Leads</label>
    </form>
    <form action="LeadTab" class="radioForm" method="get">
        <input type="text" id="opportunity" name="type" value="Opportunity" readonly />
        <label for="opportunity">Opportunities</label>
    </form>
    <form action="LeadTab" class="radioForm" method="get">
        <input type="text" id="active_customer" name="type" value="Active Customer" readonly />
        <label for="active_customer">Active Customers</label>
    </form>
    <form action="LeadTab" class="radioForm" method="get">
        <input type="text" id="non_active_customer" name="type" value="Non Active Customer" readonly />
        <label for="non_active_customer">Dead Leads</label>
    </form>
</div> -->
<!-- radioForm -->
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
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->type) ? $lead->type:'--')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(!empty($lead->phone) ? $lead->phone:'--'); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->email) ? $lead->email:'--')); ?></span>
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
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">...</a>
                                            <div class="dropdown-menu py-0">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
                                                    <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" class="dropdown-item" data-bs-toggle="tooltip" title='Edit Lead Details'>Edit</a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                                    <a href="#" data-size="lg" data-url="<?php echo e(route('lead.show',$lead->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Lead Details')); ?>" class="dropdown-item" data-bs-toggle="tooltip" title='View Lead Details'>View</a>
                                                <?php endif; ?>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]); ?>

                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                <?php echo Form::close(); ?>

                                                <?php if(!empty($lead->industryProduct) && !empty($lead->lead_interaction) && $lead->mail_sent == 0): ?>
                                                <form method="POST" action="<?php echo e(route('leadApprovalMail')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="lead_id" value="<?php echo e($lead->id); ?>">
                                                    <button type="submit" class="dropdown-item">Send Approval Email</button>
                                                </form>
                                                <?php endif; ?>
                                                <a href="#" data-size="lg" data-url="<?php echo e(route('addInteration',$lead->id)); ?>" class="dropdown-item" data-bs-toggle="tooltip" title='Add New Interaction' data-ajax-popup="true" data-title="<?php echo e(__('Add Interation')); ?>">Add Interaction</a>
                                                <a href="#" data-size="lg" data-url="<?php echo e(route('addQuotation',$lead->id)); ?>" class="dropdown-item" data-bs-toggle="tooltip" title='Send Quotation' data-ajax-popup="true" data-title="<?php echo e(__('Send Quotation')); ?>">Send Quotation</a>
                                            </div>
                                        </div>
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

<?php $__env->startPush('script-page'); ?>
<script>
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
        document.getElementById('error-message').style.display = 'none';
    }, 3000);


    // $(".radioForm").click(function(){
    //     $(this).addClass('active')
    //     $(this).siblings().removeClass('active')
    // })

    // $('#lead').click(function(){
    //     $('#leadType').val('Lead');
    // })

    // $('#opportunity').click(function(){
    //     $('#leadType').val('Opportunity');
    // })

    // $('#active_customer').click(function(){
    //     $('#leadType').val('Active Customer');
    // })

    // $('#non_active_customer').click(function(){
    //     $('#leadType').val('Non Active Customer');
    // })

    $(document).ready(function() {
        $(document).on('change','#product-select',function() {
            var productId = $(this).val();
            if (productId !== '') {
                // Make an AJAX request to fetch the product price
                $.ajax({
                    url: '/get-product-price',
                    type: 'GET',
                    data: { productId: productId },
                    success: function(response) {
                        // Update the price input with the fetched price
                        $('#price-input').val(response.price);
                    },
                    error: function() {
                        // Handle error if the AJAX request fails
                        console.log('Error occurred while fetching the product price.');
                    }
                });
            } else {
                // Clear the price input if no product is selected
                $('#price-input').val('');
            }
        });

        $(document).on('change','#discount-input',function() {
            var price = parseFloat($('#price-input').val());
            var discount = parseFloat($(this).val());
            if (!isNaN(price) && !isNaN(discount)) {
                var finalAmount = price - (price * discount / 100);
                $('#final-amount').val(finalAmount.toFixed(2));
            } else {
                $('#final-amount').val('');
            }
        });
    });
</script>

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\addonix\resources\views/lead/index.blade.php ENDPATH**/ ?>