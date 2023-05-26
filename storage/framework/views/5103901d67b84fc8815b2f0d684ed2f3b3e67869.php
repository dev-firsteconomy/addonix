<?php
    $setting = App\Models\Utility::colorset();
    // $color = 'theme-3';
    // if (!empty($setting['color'])) {
    //     $color = $setting['color'];
    // }
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $lang = Utility::getValByName('default_language');

    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_favicon = Utility::getValByName('company_favicon');
    $setting = Utility::settings();
    $company_logo = \App\Models\Utility::GetLogo();
    $seo_setting = App\Models\Utility::getSeoSetting();

    // dd($setting);
    // @dd($logo);
    $footer_text = isset(\App\Models\Utility::settings()['footer_text']) ? \App\Models\Utility::settings()['footer_text'] : '';
?>
<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($setting['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Salesy Saas- Business Sales CRM" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />
    <title>
        <?php echo e(Utility::getValByName('header_text') ? Utility::getValByName('header_text') : config('app.name', 'Salesy SaaS')); ?>

        - <?php echo $__env->yieldContent('page-title'); ?></title>
    <!-- Primary Meta Tags -->

    <meta name="title" content="<?php echo e($seo_setting['meta_keywords']); ?>">
    <meta name="description" content="<?php echo e($seo_setting['meta_description']); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($seo_setting['meta_keywords']); ?>">
    <meta property="og:description" content="<?php echo e($seo_setting['meta_description']); ?>">
    <meta property="og:image" content="<?php echo e(asset('uploads/metaevent/' . $seo_setting['meta_image'])); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($seo_setting['meta_keywords']); ?>">
    <meta property="twitter:description" content="<?php echo e($seo_setting['meta_description']); ?>">
    <meta property="twitter:image" content="<?php echo e(asset('uploads/metaevent/' . $seo_setting['meta_image'])); ?>">
    <link rel="icon" href="<?php echo e($logo . '/favicon.png'); ?>" type="image/png">


    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('public/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?> ">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/site.css')); ?>" id="stylesheet">
    <!-- vendor css -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <?php if($setting['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>
    <?php if(isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <?php endif; ?>

</head>

<body class="<?php echo e($color); ?>">
    <div class="auth-wrapper auth-v3">
        <div class="bg-auth-side bg-primary"></div>
        <div class="auth-content">
            <nav class="navbar navbar-expand-md navbar-light default">
                <div class="container-fluid pe-2">
                    <a class="" href="#">
                        
                        <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                            alt="logo" class="logo logo-lg nav-sidebar-logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                        <ul class="navbar-nav align-items-center ms-auto ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Support</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Terms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Privacy</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <?php echo $__env->yieldContent('language-bar'); ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <?php echo $__env->yieldContent('content'); ?>

            <div class="auth-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            
                            <p class="text-mute"><?php echo e($footer_text); ?> </p>
                        </div>
                        <div class="col-6 text-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="<?php echo e(asset('assets/js/vendor-all.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<?php if($setting['enable_cookie'] == 'on'): ?>
    <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->yieldPushContent('custom-scripts'); ?>

</html>
<?php /**PATH D:\Laravel Projects\addonix\resources\views/layouts/auth.blade.php ENDPATH**/ ?>