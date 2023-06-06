

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>
<?php

?>
<?php $__env->startSection('language-bar'); ?>
    <li class="nav-item bth-primary">
        <select name="language" id="language" class="btn btn-primary ms-2 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('login',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="card-body">
                    <div class="">
                        <h2 class="mb-3 f-w-600"><?php echo e(__('Login')); ?></h2>
                    </div>
                    <?php echo e(Form::open(array('route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form form_data'))); ?>

                        <div class="">
                            <div class="form-group mb-3">
                                <label class="form-label"><?php echo e(__('Email')); ?></label>
                                <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')])); ?>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-email text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><?php echo e(__('Password')); ?></label>
                                <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password')])); ?>

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-password text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="d-grid">
                                <a href="<?php echo e(route('password.request', $lang)); ?>" class=""><small><?php echo e(__('Forgot your password?')); ?></small></a>
                            </div>

                            <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
                                <div class="form-group col-lg-12 col-md-12 mt-3">
                                    <?php echo NoCaptcha::display(); ?>

                                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="small text-danger" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-grid">
                                <?php echo e(Form::submit(__('Login'), ['class' => 'btn btn-primary btn-block mt-2', 'id' => 'saveBtn'])); ?>

                            </div>

                            <?php if(Utility::getValByName('signup_button') == 'on'): ?>
                                <p class="my-4 text-center"><?php echo e(__('Don \'t have an account?')); ?><a href="<?php echo e(route('register', $lang)); ?>" class="my-4 text-center text-primary"> <?php echo e(__('Register')); ?></a></p>

                            <?php endif; ?>
                        </div>
                    <?php echo e(Form::close()); ?>


                </div>
            </div>
            <div class="col-xl-6 img-card-side">
                <div class="auth-img-content">
                    <img src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>" alt="" class="img-fluid">
                    <h3 class="text-white mb-4 mt-5"><?php echo e(__('Attention is the new currency')); ?></h3>
                    <p class="text-white"><?php echo e(__('The more effortless the writing looks, the more effort the writer
                        actually put into the process.')); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>
<script src="<?php echo e(asset('public/libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $(".form_data").submit(function(e) {
                $(".login_button").attr("disabled", true);
                return true;
            });
        });

    </script>
    <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\addonix\resources\views/auth/login.blade.php ENDPATH**/ ?>