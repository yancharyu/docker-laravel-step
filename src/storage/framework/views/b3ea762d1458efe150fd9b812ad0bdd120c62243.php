<?php $__env->startSection('title', __('ログイン')); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('login')); ?>" method="POST" class="c-form">
    <?php echo csrf_field(); ?>

    <h1 class="c-form__title"><?php echo e(__('ログイン')); ?></h1>
    <?php $__env->startComponent('components.input'); ?>
    <?php $__env->slot('labelTitle', 'メールアドレス'); ?>
    <?php $__env->slot('inputType', 'text'); ?>
    <?php $__env->slot('inputName', 'email'); ?>
    <?php echo $__env->renderComponent(); ?>

    <vue-password-input label-title="<?php echo e(__('パスワード')); ?>" input-name="password" <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> error-message="<?php echo e($message); ?>" <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>></vue-password-input>

    <?php $__env->startComponent('components.checkbox'); ?>
    <?php $__env->slot('inputName', 'remember'); ?>
    <?php $__env->slot('labelTitle', 'ログイン情報を保存'); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.button', ['btnClassNames' => 'c-btn--flRight']); ?>
    <?php $__env->slot('btnText', 'ログイン'); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php if(Route::has('password.request')): ?>
    <a class="c-form__item c-form__link" href="<?php echo e(route('password.request')); ?>">
        <?php echo e(__('パスワードをお忘れですか？')); ?>

    </a>
    <?php endif; ?>


</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/auth/login.blade.php ENDPATH**/ ?>