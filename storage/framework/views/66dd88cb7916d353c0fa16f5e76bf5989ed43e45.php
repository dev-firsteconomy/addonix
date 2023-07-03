
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Lead')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>

<style>

.radioForm button {
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

.radioForm.active  button {
    background: #2bdc52;
    color: #fff;
    border-color: #2bdc52;
}

.datatable .dropdown-toggle::after {
    display: none;
}

.viewData input {
    border: 0;
}

.prodcut-heading{
    font-size:25px;
    font-weight:600;
}

</style> 


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
<a href="<?php echo e(route('lead.create')); ?>" 
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
        <div class="col-lg-5">
            <div class="input-group mb-3">
            <span class="input-group-text">From Date:</span>
            <input type="date" name="fromDate" class="form-control">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="input-group mb-3">
            <span class="input-group-text">To Date:</span>
            <input type="date" name="toDate" class="form-control">
            </div>
        </div>
        <input type="hidden" value="Lead" id="leadType" name="leadType">
        <!-- <div class="col-lg-4">
            <div class="input-group mb-3">
            <span class="input-group-text">Type:</span>
            <select class="form-select" aria-label="Default select example" name="leadType">
                <option value="">Select...</option>
                <option value="Lead" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Lead' ? 'selected' : ''); ?>>Lead</option>
                <option value="Opportunity" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Opportunity' ? 'selected' : ''); ?> >Opportunity</option>
                <option value="Active Customer" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Active Customer' ? 'selected' : ''); ?>>Active Customer</option>
                <option value="Non Active Customer" <?php echo e(isset($_REQUEST['leadType']) && $_REQUEST['leadType'] == 'Non Active Customer' ? 'selected' : ''); ?>>Non Active Customer</option>
            </select>
            </div>
        </div> -->
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
<!-- radioForm -->
<div class="radioFormWrapper d-flex gap-4 mb-3">
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="lead" name="type" value="Lead">Leads</button>
    </form>
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="opportunity" name="type" value="Opportunity">Opportunity</button>
    </form>
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="active_customer" name="type" value="Active Customer">Active Customer</button>
    </form>
    <form action="leadTab" class="radioForm" method="get">
        <button class="tabBtn" type="submit" id="non_active_customer" name="type" value="Non Active Customer">Non Active Customer</button>
    </form>
</div>
<!-- radioForm -->
<div class="row">
    <div class="col-xl-12">
    <?php if(Session::has('success')): ?>
    <div id="success-message" class="alert alert-success" role="alert" >
        <?php echo e(Session::get('success')); ?>

    </div>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
    <div id="error-message" class="alert alert-error" role="alert" >
        <?php echo e(Session::get('error')); ?>

    </div>
    <?php endif; ?>
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Company Name')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Company Contact No.')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Email')); ?></th>
                                <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Lead Type')); ?></th>
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
                                    <span class="budget"><?php echo e(ucfirst(@$lead->company_name)); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(@$lead->phone); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(@$lead->email)); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(@$lead->type)); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->website) ? $lead->website:'-')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->industry_vertical) ? $lead->industry_vertical:'-')); ?></span>
                                </td>

                                <td>
                                    <span class="budget"><?php echo e(ucfirst(!empty($lead->assign_user_id) ? $lead->assign_user_id:'-')); ?></span>
                                </td>

                                <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead')): ?>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">...</a>
                                            <div class="dropdown-menu py-0">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
                                                    <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" class="dropdown-item">Edit</a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                                    <a href="<?php echo e(route('lead.show',$lead->id)); ?>" data-size="lg" class="dropdown-item">View</a>
                                                <?php endif; ?>
                                                <?php if($lead->type == 'Lead' && $lead->industryProduct->isNotEmpty() && $lead->lead_interaction->isNotEmpty() && $lead->mail_sent == 0): ?>
                                                <a href="#" data-size="lg" data-url="<?php echo e(route('approvalEmail',$lead->id)); ?>" data-id="<?php echo e($lead->id); ?>" data-ajax-popup="true" class="dropdown-item">Send Approval Email</a>
                                                <?php endif; ?>
                                                <a href="#" data-size="lg" data-url="<?php echo e(route('addInteration',$lead->id)); ?>" data-ajax-popup="true" class="dropdown-item">Add Interaction</a>
                                                <?php if($lead->type == 'Opportunity' && $lead->industryProduct->isNotEmpty() && $lead->lead_interaction->isNotEmpty() && $lead->mail_sent == 1): ?>
                                                    <a href="#" data-size="lg" data-url="<?php echo e(route('addQuotation',$lead->id)); ?>" class="dropdown-item" data-ajax-popup="true" data-title="<?php echo e(__('Generate Quotation')); ?>">Generate Quotation</a>
                                                <?php endif; ?>
                                                <a href="#" data-size="lg" data-url="<?php echo e(route('convertToOpportunityModal',$lead->id)); ?>" class="dropdown-item" data-ajax-popup="true" data-title="<?php echo e(__('Convert To Opportunity')); ?>">Convert To Opportunity</a>
                                                <?php if($lead->type == 'Opportunity' && $lead->industryProduct->isNotEmpty() && $lead->lead_interaction->isNotEmpty() && $lead->mail_sent == 1): ?>
                                                    <a href="#" data-size="lg" data-url="<?php echo e(route('addPerforma',$lead->id)); ?>" class="dropdown-item" data-ajax-popup="true" data-title="<?php echo e(__('Generate Performa Invoice')); ?>">Generate Performa Invoice</a>
                                                <?php endif; ?>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]); ?>

                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                <?php echo Form::close(); ?>

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
    let productPrice;
    $(document).ready(function() {

        const currentUrl = window.location.href;

        // Check if the URL contains 'leadTab?type'
        if (currentUrl.includes('leadTab?type') || currentUrl.includes('leadSearch?')) {
            // Check if we have a stored value for "lastClickedButton"
            var lastClickedButton = localStorage.getItem('lastClickedButton') ? localStorage.getItem('lastClickedButton') : 'lead' ;
            var lastClickedType = localStorage.getItem('lastClickedType') ? localStorage.getItem('lastClickedType') : 'lead' ;
            
            if (lastClickedButton) {
                // If we do, add 'active' class to the button
                $('#' + lastClickedButton).parent().addClass('active');
            }

            if(lastClickedType){
                $('#leadType').val(lastClickedType);
            }
        }else{
            $('#lead').parent().addClass('active'); 
        }


        $(".tabBtn").click(function() {
            // When a button is clicked, remove 'active' class from all buttons
            $('.tabBtn').removeClass('active');
            
            // Add 'active' class to clicked button
            $(this).addClass('active');

            // Store the id of the clicked button
            localStorage.setItem('lastClickedButton', this.id);
            localStorage.setItem('lastClickedType', this.value);

            $('#leadType').val(this.value);

            // ... continue with your existing click handler code ...
        });

        
        // $(".radioForm").click(function(){
        //     $(this).addClass('active')
        //     $(this).siblings().removeClass('active')
        // })
    });


    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
        document.getElementById('error-message').style.display = 'none';
    }, 3000);

    $(document).ready(function() {
        var quantity = 1;

        $(document).on('click', '#increaseButton', function() {
            var quantity = parseInt($("#quantityInput").val());
            quantity++;
            $("#quantityInput").val(quantity);
            if(typeof productPrice !== "undefined"){ // Check if productPrice is defined.
                var quantityPrice = quantity * productPrice;
                $('#price-input').val(quantityPrice);
            } else {
                $('#price-input').val('');
            }
        });


        $(document).on('click', '#decreaseButton', function() {
            var quantity = parseInt($("#quantityInput").val()); // Added parseInt to convert the value to a number.
            if(quantity > 1) {
                quantity--;
                $("#quantityInput").val(quantity);
                if(typeof productPrice !== "undefined"){ // Added typeof to check if productPrice is defined.
                    var quantityPrice = quantity * productPrice;
                    $('#price-input').val(quantityPrice);
                } else {
                    $('#price-input').val('');
                }
            }
        });

    
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
                        productPrice = response.price;
                        var quantityPrice = $('#quantityInput').val() * productPrice;
                        $('#price-input').val(quantityPrice)
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

        $(document).on('change','#interaction_activity_type',function() {
            var selectedValue = $(this).val();
            if (selectedValue == 'Demo') {
                $('.demo').show();
            } else {
                $('.demo').hide();
            }
        });

        $(document).on('click','#sendEmailSubmit',function(e) {
            e.preventDefault(); //prevent the form from actually submitting
            console.log('dd');
            var body;
            if(AmazeIsAllFormValid())
            {
                $.ajax({
                    url: '/verifyHtml',
                    type: 'GET',
                    data: { leadId: $('#lead_id').val() },
                    success: function(response) {
                        // Update the price input with the fetched price
                        body = response.html;

                        var userEmail = $('#to_email').val()
                        var ccEmail = $('#cc_email').val()
            
                        var subject = 'Mail subject goes here';
                        // var body = 'Body content goes here';
            
                        var mailtoLink = 'mailto:' + userEmail + '?cc=' + ccEmail + '&subject=' + subject + '&body=' + body;
                        
                        // Create a hidden anchor tag and simulate a click
                        var link = document.createElement('a');
                        link.href = mailtoLink;
                        link.style.display = 'none';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        $('#commonModal').modal('hide');
                    },
                    error: function() {
                        // Handle error if the AJAX request fails
                        console.log('Error occurred while fetching the product price.');
                    }
                });
            }
        });

       
    });

  

    function AmazeIsAllFormValid() {
        var isValid = true;
        if (!inputIsValid($('#to_email').val().trim())) {
          $('#error_to_email').html('Please enter your first name.');
          isValid = false;
        } else {
          $('#error_to_email').html('');
        }
        if (!inputIsValid($('#cc_email').val().trim())) {
          $('#error_cc_email').html('Please enter your last name.');
          isValid = false;
        } else {
          $('#error_cc_email').html('');
        }
        return isValid;
    }

    function inputIsValid(schedule_data) {
        var FooterIsValid = true
        if (
          schedule_data == undefined ||
          schedule_data == 'undefined' ||
          schedule_data == null ||
          schedule_data == '' ||
          schedule_data.length == 0
        ) {
          FooterIsValid = false
        }
        return FooterIsValid
    }

    // if(document.getElementById('co-add-field') && document.getElementById('co-remove-field')){
    //     document.getElementById('co-add-field').addEventListener('click', function() {
    //         const container = document.getElementById('co-repeater-container');
    //         const lastRow = container.querySelector('.co-repeater:last-of-type');
    //         const newRow = lastRow.cloneNode(true);
    //         const inputs = newRow.querySelectorAll('.co-repeater-input');
    //         const selects = newRow.querySelectorAll('co-repeater-select');
    
    //         // Clear input field values in the new row
    //         inputs.forEach(input => {
    //             input.value = '';
    //         });
    
    //         container.appendChild(newRow);
    //     });
    
    //     // Remove row
    //     var removeButton = document.getElementById('co-remove-field');
    //     var repeaterContainer = document.getElementById('co-repeater-container');
    //     removeButton.addEventListener('click', function() {
    //         var repeaterRows = repeaterContainer.querySelectorAll('.co-repeater');
    //         if (repeaterRows.length > 1) {
    //             var lastRow = repeaterRows[repeaterRows.length - 1];
    //             lastRow.parentNode.removeChild(lastRow);
    //         }
    //     });
    // }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\addonix\resources\views/lead/index.blade.php ENDPATH**/ ?>