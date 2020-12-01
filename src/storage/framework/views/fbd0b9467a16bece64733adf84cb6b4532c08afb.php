<?php $__env->startSection('title', __('パスワード変更')); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('edit_password')); ?>" method="POST" class="c-form">
    <?php echo csrf_field(); ?>
    <h1 class="c-form__title"><?php echo e(__('パスワード変更')); ?></h1>

    <vue-password-input label-title="<?php echo e(__('現在のパスワード')); ?>" input-name="current_password" <?php if ($errors->has('current_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('current_password'); ?> error-message="<?php echo e($message); ?>" <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>></vue-password-input>

    <vue-password-input label-title="<?php echo e(__('新しいパスワード')); ?>" input-name="new_password" <?php if ($errors->has('new_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('new_password'); ?> error-message="<?php echo e($message); ?>" <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>></vue-password-input>

    <vue-password-input label-title="<?php echo e(__('パスワード確認用')); ?>" input-name="new_password_confirmation" <?php if ($errors->has('new_password_confirmation')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('new_password_confirmation'); ?> error-message="<?php echo e($message); ?>" <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>></vue-password-input>

    <?php $__env->startComponent('components.button', ['btnClassNames' => 'c-btn--flRight']); ?>
    <?php $__env->slot('btnText', '変更する'); ?>
    <?php echo $__env->renderComponent(); ?>


</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/pages/edit_password.blade.php ENDPATH**/ ?>