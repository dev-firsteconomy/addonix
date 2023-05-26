
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <?php if(\Auth::user()->type == 'owner'): ?>
                <div class="col-xxl-7">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-warning">
                                                <i class="ti ti-user"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total User')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalUser']); ?> </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-success">
                                                <i class="ti ti-building"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Account')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalAccount']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-danger">
                                                <i class="fas fa-id-badge"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Contact')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalContact']); ?> </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-info">
                                                <i class="fas fa-address-card"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Lead')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalLead']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-info">
                                                <i class="ti ti-currency-dollar-singapore"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Opportunities')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalOpportunities']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-receipt"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Invoices')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalInvoice']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-secondary">
                                                <i class="ti ti-file-invoice"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Salesorder')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalSalesorder']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-dark">
                                                <i class="ti ti-brand-producthunt"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"></p>
                                            <h6 class="mb-3"><?php echo e(__('Total Product')); ?></h6>
                                            <h3 class="mb-0"><?php echo e($data['totalProduct']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(\Auth::user()->type == 'owner'): ?>
                 <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Invoice'.' '.'&'.' '.'Quote'.' '.'&'.' '.'Sales Order')); ?></h5>
                        </div>
                        <div class="card-body adj_card">
                            <div id="traffic-chart"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(\Auth::user()->type != 'owner'): ?>
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Invoice'.' '.'&'.' '.'Quote'.' '.'&'.' '.'Sales Order')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div id="traffic-chart"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <div class="card" style="min-height:205px;">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Invoice Overview')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="progress">
                                                <?php $__currentLoopData = $data['invoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="progress-bar bg-<?php echo e($data['invoiceColor'][$invoice['status']]); ?>" role="progressbar" style="width: <?php echo e($invoice['percentage']); ?>%" aria-valuenow="<?php echo e($invoice['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="row mt-3">
                                                <?php $__empty_1 = true; $__currentLoopData = $data['invoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <div class="col-md-6 text-justify">
                                                        <span class="text-sm text-<?php echo e($data['invoiceColor'][$invoice['status']]); ?>">●</span>
                                                        <small><?php echo e($invoice['data'].' '.__($invoice['status'])); ?> (<a href="#" class="text-sm text-muted"><?php echo e(number_format($invoice['percentage'],'2')); ?>%</a>)</small>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <h6><?php echo e(__('Invoice record not found')); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="card" style="min-height:205px;">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Quote Overview')); ?></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="progress">
                                                <?php $__currentLoopData = $data['quote']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="progress-bar bg-<?php echo e($data['invoiceColor'][$quote['status']]); ?>" role="progressbar" style="width: <?php echo e($quote['percentage']); ?>%" aria-valuenow="<?php echo e($quote['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="row mt-3">
                                                <?php $__empty_1 = true; $__currentLoopData = $data['quote']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <div class="col-md-6 text-justify">
                                                        <span class="text-sm text-<?php echo e($data['invoiceColor'][$quote['status']]); ?>">●</span>
                                                        <small><?php echo e($quote['data'].' '.__($quote['status'])); ?> (<a href="#" class="text-sm text-muted"><?php echo e(number_format($quote['percentage'],'2')); ?>%</a>)</small>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <h6><?php echo e(__('Quote record not found')); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="card" style="min-height:205px;">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Sales Order Overview')); ?></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="progress">
                                                <?php $__currentLoopData = $data['salesOrder']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="progress-bar bg-<?php echo e($data['invoiceColor'][$salesOrder['status']]); ?>" role="progressbar" style="width: <?php echo e($salesOrder['percentage']); ?>%" aria-valuenow="<?php echo e($salesOrder['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="row mt-3">
                                                <?php $__empty_1 = true; $__currentLoopData = $data['salesOrder']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <div class="col-md-6 text-justify">
                                                        <span class="text-sm text-<?php echo e($data['invoiceColor'][$salesOrder['status']]); ?>">●</span>
                                                        <small><?php echo e($salesOrder['data'].' '.__($salesOrder['status'])); ?> (<a href="#" class="text-sm text-muted"><?php echo e(number_format($salesOrder['percentage'],'2')); ?>%</a>)</small>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <h6><?php echo e(__('Invoice record not found')); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0"><?php echo e(__('Meeting Schedule')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="list-group overflow-auto list-group-flush dashboard-box">
                            <?php $__empty_1 = true; $__currentLoopData = $data['topMeeting']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <a href="#!" class=" h6 mb-0"><?php echo e($meeting->name); ?></a>
                                            <div>
                                                <small><?php echo e($meeting->description); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <span data-toggle="tooltip" data-title="<?php echo e(__('Meetign Date')); ?>"><?php echo e($meeting->start_date); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-md-12 text-center">
                                    <h6 class="m-3"><?php echo e(__('Meeting schedule not found')); ?></h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0"><?php echo e(__('Top Due Task')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="list-group overflow-auto list-group-flush dashboard-box">
                            <?php $__empty_1 = true; $__currentLoopData = $data['topDueTask']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topDueTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <a href="#!" class=" h6 mb-0"><?php echo e($topDueTask->name); ?></a>
                                            <div>
                                                <small><?php echo e(__('Assign to')); ?> <?php echo e(!empty($topDueTask->assign_user)?$topDueTask->assign_user->name  :''); ?></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <span data-toggle="tooltip" data-title="<?php echo e(__('Project Title')); ?>"><?php echo e($topDueTask->description); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <span data-toggle="tooltip" data-title="<?php echo e(__('Due Date')); ?>"><?php echo e(\Auth::user()->dateFormat($topDueTask->due_date)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-md-12 text-center">
                                    <h6 class="m-3"><?php echo e(__('Task record not found')); ?></h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php

                $setting = App\Models\Utility::settings();

                ?>
                <div class="row">
                    <!-- [ sample-page ] start -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                
                                <select class="form-control" name="calender_type" id="calender_type"
                                    style="float: right;width: 150px;">
                                    <option value="goggle_calender"><?php echo e(__('Google Calender')); ?></option>
                                    <option value="local_calender" selected="true"><?php echo e(__('Local Calender')); ?></option>
                                </select>
                                <?php endif; ?>
                                <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">

                            </div>

                            <div class="card-body">
                                <div id='calendar' class='calendar'></div>
                            </div>
                        </div>
                    </div>



                    <!-- [ sample-page ] end -->
                </div>

            </div>
            <!-- [ sample-page ] end -->
        </div>

    <!-- [ Main Content ] end -->
</div>





<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script>
    (function () {
        var options = {
            chart: {
                height: 140,
                type: 'donut',
            },
            dataLabels: {
                enabled: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                    }
                }
            },
            series: [26, 26, 26, 26],
            colors: ["#CECECE", '#ffa21d', '#FF3A6E', '#3ec9d6'],
            labels: ["Other", "Adobe", "Atlassian", "Slack", "Spotify"],
            legend: {
                show: false
            }
        };
        var chart = new ApexCharts(document.querySelector("#projects-chart"), options);
        chart.render();
    })();
    (function () {
        var options = {
            chart: {
                height: 220,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            series: [
                {
                name: "<?php echo e(__('Quote')); ?>",
                data:  <?php echo json_encode($data['lineChartData']['quoteAmount']); ?>

                // data: [20, 50, 30, 60, 40, 50, 40]
            }, {
                name: "<?php echo e(__('Invoice')); ?>",
                data: <?php echo json_encode($data['lineChartData']['invoiceAmount']); ?>

                // data: [40, 20, 60, 15, 50, 65, 20]
            }, {
                name: "<?php echo e(__('Sales Order')); ?>",
                 data: <?php echo json_encode($data['lineChartData']['salesorderAmount']); ?>

                // data: [50, 65, 50, 40, 30, 45, 60]
            }
            ],
            xaxis: {
                categories: <?php echo json_encode($data['lineChartData']['day']); ?>,
                title: {
                    text: "<?php echo e(__('Days')); ?>"
                }
                // categories: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            colors: ['#453b85', '#FF3A6E', '#3ec9d6'],

            grid: {
                strokeDashArray: 4,
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
            },

            yaxis: {
                min: 10,
                max: 70,
                title: {
                    text: '<?php echo e(__('Amount')); ?>'
                },
            }
        };
        var chart = new ApexCharts(document.querySelector("#traffic-chart"), options);
        chart.render();
    })();
</script>


<script type="text/javascript">
    (function () {
        var options = {
            chart: {
                type: 'area',
                height: 90,
                sparkline: {
                    enabled: true,
                },
            },
            colors: ["#ffa21d"],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            series: [{
                name: 'Bandwidth',
                data: [41, 109, 45, 109, 34, 72, 41]
            }],
            xaxis: {
                categories: ['Apr', 'Jun', 'Aug', 'Oct', 'Oct', 'Nov', 'Dec'],
                tooltip: {
                    enabled: false,
                }
            },
            tooltip: {
                followCursor: false,
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        }
        var chart = new ApexCharts(document.querySelector("#task-chart"), options);
        chart.render();
    })();

    <?php
    $segment=Request::segment(2);
    ?>

    $(document).ready(function()
    {
        get_data();
    });

    function get_data()
    {
        var segment="<?php echo e($segment); ?>";
        if(segment=='call'){
            var urls=$("#path_admin").val()+"/call/get_call_data";
        }
        else if(segment=='meeting'){
            var urls=$("#path_admin").val()+"/meeting/get_meeting_data";
        }
        else if(segment=='task'){
            var urls=$("#path_admin").val()+"/task/get_task_data";
        }
        else{
            var urls=$("#path_admin").val()+"/all-data";
        }

        var calender_type=$('#calender_type :selected').val();
        $('#calendar').removeClass('local_calender');
        $('#calendar').removeClass('goggle_calender');

        if(calender_type == undefined){
            calender_type = 'local_calender';
        }

        $('#calendar').addClass(calender_type);
        $.ajax({
            url: urls ,
            method:"POST",
            data: {"_token": "<?php echo e(csrf_token()); ?>",'calender_type':calender_type},
            success: function(data) {
                // console.log(data);
                (function() {
                    var etitle;
                    var etype;
                    var etypeclass;
                    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        buttonText: {
                            timeGridDay: "<?php echo e(__('Day')); ?>",
                            timeGridWeek: "<?php echo e(__('Week')); ?>",
                            dayGridMonth: "<?php echo e(__('Month')); ?>"
                        },
                        slotLabelFormat: {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: false,
                                },
                        themeSystem: 'bootstrap',
                        // slotDuration: '00:10:00',
                        navLinks: true,
                        droppable: true,
                        selectable: true,
                        selectMirror: true,
                        editable: true,
                        dayMaxEvents: true,
                        handleWindowResize: true,
                        height: 'auto',
                        timeFormat: 'H(:mm)',
                        events: data,
                        // eventContent: function(event, element, view) {
                        //             var customHtml = event.event._def.extendedProps.html;
                        //             return {
                        //                 html: customHtml
                        //             }
                        //     }

                    });

                    calendar.render();
                })();
            }
        });
        }
</script>


    <script>
        var options = {
            series: [
                {
                    name: "<?php echo e(__('Quote')); ?>",
                    data:  <?php echo json_encode($data['lineChartData']['quoteAmount']); ?>

                },
                {
                    name: "<?php echo e(__('Invoice')); ?>",
                    data: <?php echo json_encode($data['lineChartData']['invoiceAmount']); ?>

                },
                {
                    name: "<?php echo e(__('Sales Order')); ?>",
                    data: <?php echo json_encode($data['lineChartData']['salesorderAmount']); ?>

                }
            ],
            chart: {

                height: 350,

                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                },

            },
            colors: ['#77B6EA', '#51cb97', '#011c4b'],
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            xaxis: {
                categories: <?php echo json_encode($data['lineChartData']['day']); ?>,
                title: {
                    text: "<?php echo e(__('Days')); ?>"
                }
            },
            yaxis: {
                title: {
                    text: '<?php echo e(__('Amount')); ?>'
                },
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            },

        };
        var chart = new ApexCharts(document.querySelector("#report-chart"), options);

        chart.render();


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel Projects\addonix\resources\views/home.blade.php ENDPATH**/ ?>