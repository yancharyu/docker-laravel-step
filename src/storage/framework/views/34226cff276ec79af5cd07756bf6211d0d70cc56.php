<?php $__env->startSection('title', __('トップページ')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.create_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="p-top">
    <div class="p-top__title"><?php echo e(__('STEP一覧')); ?></div>
    <vue-step></vue-step>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/pages/index.blade.php ENDPATH**/ ?>