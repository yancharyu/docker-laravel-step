<?php $__env->startSection('title', __('ステージ詳細')); ?>

<?php $__env->startSection('content'); ?>
<div class="p-stage">
    <div class="p-stage__main">

        <h1 class="p-stage__title">「 <?php echo e($stage->title); ?> 」</h1>

        
        <?php if($is_before_stage_achievement): ?>

        <?php echo e(__('概要')); ?>

        <div class="p-stage__summary"><?php echo e($stage->summary ?? '概要はありません'); ?></div>
        <p class="p-stage__time"><?php echo e(__('目安達成時間')); ?>： <?php echo e($stage->time); ?>h</p>
        
        <?php if($is_achievement): ?>
        <button class="c-btn c-btn--flRight c-btn--disabled p-stage__alClearButton"><?php echo e(__('クリア済み')); ?></button>
        <?php else: ?>
        
        <form action="<?php echo e(route('step.achievement')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="stage_id" :value="<?php echo e($stage->id); ?>">
            <div class="c-btnContainer">
                <button class="c-btn c-btn--flRight p-stage__clearButton"><?php echo e(__('クリア！')); ?></button>
            </div>
        </form>
        <?php endif; ?>
        <?php else: ?>
        
        <div class=" p-stage__noAchievement"><?php echo e(__('前のステージをクリアで開放')); ?>

        </div>
        <?php endif; ?>
    </div>

    
    <div class=" p-stageSidebar">
        <h1 class="p-stageSidebar__title"><?php echo e(__('ステージ一覧')); ?></h1>
        <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('step.stage', $item->id)); ?>" class="c-stage <?php if($item->id === $stage->id): ?> c-stage--isActive <?php endif; ?>">
            <?php echo e(__('ステージ')); ?><?php echo e($key + 1); ?>

            <h2 class="c-stage__title">「<?php echo e($item->title); ?>」</h2>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/pages/stage.blade.php ENDPATH**/ ?>