
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
    <li class="breadcrumb-item "><?php echo e(__('Lead')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
        <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>">
            <i class="ti ti-list text-white"></i>
        </a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Lead')): ?>
        <a href="#" data-url="<?php echo e(route('lead.create',['lead',0])); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Lead')); ?>"title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>


<script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>

<script>
    !function (a) {
        "use strict";
        var t = function () {
            this.$body = a("body")
        };
        t.prototype.init = function () {
            a('[data-plugin="dragula"]').each(function () {
                var t = a(this).data("containers"), n = [];
                if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                var r = a(this).data("handleclass");
                r ? dragula(n, {
                    moves: function (a, t, n) {
                        return n.classList.contains(r)
                    }
                }) : dragula(n).on('drop', function (el, target, source, sibling) {

                    var order = [];
                    $("#" + target.id + " > div").each(function () {
                        order[$(this).index()] = $(this).attr('data-id');
                    });

                    var id = $(el).attr('data-id');

                    var old_status = $("#" + source.id).data('status');
                    var new_status = $("#" + target.id).data('status');
                    var stage_id = $(target).attr('data-id');
                    var pipeline_id = '1';
                    var status_id = $(target).attr('data-id');

                    $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                    $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);

                    $.ajax({
                        url: '<?php echo e(route('lead.change.order')); ?>',
                        type: 'POST',
                        data: {lead_id: id, status_id: status_id, order: order, "_token": $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            show_toastr('Success', 'Lead successfully updated', 'success');
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('<?php echo e(__("Error")); ?>', data.error, 'error')


                        }
                    });
                });
            })
        }, a.Dragula = new t, a.Dragula.Constructor = t
    }(window.jQuery), function (a) {
        "use strict";

        a.Dragula.init()

    }(window.jQuery);
</script>

    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">

        <?php
            $json = [];
            foreach($statuss as $id => $status){
                $json[] = 'kanban-blacklist-'.$id;
            }
        ?>

        <div class="row kanban-wrapper horizontal-scroll-cards kanban-board" data-containers='<?php echo json_encode($json); ?>' data-plugin="dragula">
            <?php $__currentLoopData = $statuss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $leads =\App\Models\Lead::leads($id);
                ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    <button class="btn btn-sm btn-primary btn-icon task-header">
                                        <span class="count text-white"><?php echo e(count($leads)); ?></span>
                                    </button>
                                </div>
                                <h4 class="mb-0"><?php echo e($status->name); ?></h4>
                            </div>
                            <div class="card-body kanban-box" id="kanban-blacklist-<?php echo e($id); ?>" data-id="<?php echo e($id); ?>">
                                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="card" data-id="<?php echo e($lead->id); ?>">
                                        <div class="pt-3 ps-3">

                                            <div class="card-header border-0 pb-0 position-relative">
                                                <h5>
                                                    <a href="<?php echo e(route('lead.edit',$lead->id)); ?>"
                                                    data-bs-whatever="<?php echo e(__('Edit Lead Details')); ?>"
                                                    data-bs-toggle="tooltip"  title data-bs-original-title="<?php echo e(__('Edit Lead Detail')); ?>" > <?php echo e(ucfirst($lead->name)); ?></a></h5>
                                                    <div class="card-header-right">
                                                        <div class="btn-group card-option">
                                                            <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead')): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
                                                                        <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" class="dropdown-item" data-size="lg">
                                                                            <i  class="ti ti-edit"></i>
                                                                            <span><?php echo e(__('Edit')); ?></span>
                                                                        </a>
                                                                    <?php endif; ?>

                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                                                    <a href="#!" class="dropdown-item" data-size="md" data-url="<?php echo e(route('lead.show', $lead->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Lead Details')); ?>">
                                                                        <i class="ti ti-eye"></i>
                                                                        <span><?php echo e(__('View Lead')); ?></span>
                                                                    </a>
                                                                    <?php endif; ?>

                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Lead')): ?>

                                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]); ?>

                                                                            <a href="#!" class="dropdown-item show_confirm">
                                                                                <i class="ti ti-trash"></i><?php echo e(__('Delete')); ?>

                                                                            </a>
                                                                            <?php echo Form::close(); ?>


                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 data-bs-toggle="tooltip" title="<?php echo e(__('Account name')); ?>"> <?php echo e(ucfirst(!empty($lead->accounts)?$lead->accounts->name:'-')); ?>

                                                </h6>
                                                <p class="text-muted text-sm" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Description')); ?>"><?php echo e($lead->description); ?></p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item d-inline-flex align-items-center"><i
                                                                class="f-16 text-primary ti ti-message-2"></i><?php echo e(\Auth::user()->priceFormat($lead->opportunity_amount)); ?></li>
                                                    </ul>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item d-inline-flex align-items-center"><i
                                                                class="f-16 text-primary ti ti-message-2"></i><?php echo e(\Auth::user()->dateFormat($lead->created_at)); ?></li>
                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- [ sample-page ] end -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel Projects\addonix\resources\views/lead/grid.blade.php ENDPATH**/ ?>