<?php $__env->startSection('title', __('マイページ')); ?>

<?php $__env->startSection('content'); ?>




<?php echo $__env->make('components.create_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<vue-mypage :user="<?php echo e($user); ?>"></vue-mypage>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/pages/mypage.blade.php ENDPATH**/ ?>