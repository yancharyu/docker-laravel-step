<?php $__env->startSection('title', __('ステップ詳細')); ?>

<?php $__env->startSection('content'); ?>
<div class="p-show">
    <div class="p-show__head">
        <a href="<?php echo e($step->canEdit($step->user_id) ? route('mypage') : route('step.profile', $step->user_id)); ?>" class="c-avatar">
            <img src="<?php echo e($step->user->getUserProfilePic()); ?>" class="c-avatar__pic">
            <span class="c-avatar__username"><?php echo e($step->user->name); ?></span>
        </a>
        
        <h1 class="p-show__title">「 <?php echo e($step->title); ?> 」</h1>
        
        <span class="p-show__category c-category"><?php echo e($step->category->name); ?></span>
        
        
        <div class="p-show__time"><?php echo e(__('トータル目安達成時間')); ?>： <?php echo e(getTotalClearTime($step->stages)); ?>h</div>
    </div>

    <div class="p-show__body">
        
        <h2 class="p-show__subtitle c-textLine"><?php echo e(__('説明')); ?></h2>
        <div class="p-show__description"><?php echo e($step->description); ?></div>

        
        <h2 class="p-show__subtitle p-show__subtitle--txtCenter c-textLine"><?php echo e(__('ステージ一覧')); ?></h2>
        <div class="p-show__stages">
            
            <?php if(!$is_challenge && !$is_cleared): ?>
            <div class="p-show__overlay">
                <div class="p-show__lockMessage"><?php echo e(__('チャレンジを押して挑戦')); ?></div>
            </div>
            <?php endif; ?>

            
            <?php $__currentLoopData = $step->stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('step.stage', $stage->id)); ?>" class="c-stage p-show__stage">
                <h3 class="c-stage__title">
                <?php echo e(__('ステージ')); ?><?php echo e($key + 1); ?>:
                「 <?php echo e($stage->title); ?> 」
            </h3>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="p-show__foot">
        
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-text="あなたの人生のSTEPを共有しよう!&#010;他の人の勉強プロセスなどを共有しながら学習できるサービス「STEP」より共有しました！&#010;&#010;『<?php echo e($step->title); ?>』&#010;" data-hashtags="STEP" data-size="large" rel="nofollow" target="_blank"></a>

        
        <div class="p-show__btnContainer">
            <?php if($is_cleared): ?>

            <button class="c-btn c-btn--show c-btn--disabled p-show__challengeButton--isClear"><?php echo e(__('クリア済み')); ?></button>
            
            <?php elseif($is_challenge): ?>
            <button class="c-btn c-btn--show c-btn--disabled p-show__challengeButton--isChallenge"><?php echo e(__('チャレンジ中')); ?></button>
            <?php else: ?>
            
            <form action="<?php echo e(route('step.challenge')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="step_id" value="<?php echo e($step->id); ?>">
                <button class="c-btn c-btn--show p-show__challengeButton"><?php echo e(__('チャレンジ')); ?></button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="p-show__iconContainer">

        
        <?php if($step->canEdit($step->user_id)): ?>
        <div class="p-show__iconItem">
            <vue-like-icon :user-id="<?php echo e($user_id); ?>" :step-id="<?php echo e($step->id); ?>" :prop-is-liked="<?php echo json_encode($is_liked, 15, 512) ?>" :prop-likes-count="<?php echo e($likes_count); ?>"></vue-like-icon>
        </div>
        <a href="<?php echo e(route('step.edit', $step->id)); ?>" class="p-show__iconItem"><i class="far fa-edit"></i><?php echo e(__('編集')); ?></a>
        <span class="js-deleteButton p-show__iconItem"><i class="far fa-trash-alt"></i><?php echo e(__('削除')); ?></span>
        <form action="<?php echo e(route('step.destroy', $step->id)); ?>" class="u-dispNone js-deleteForm" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
        <?php else: ?>
        <div class="p-show__iconItem p-show__iconItem--widthMax">
            <vue-like-icon :user-id="<?php echo e($user_id); ?>" :step-id="<?php echo e($step->id); ?>" :prop-is-liked="<?php echo json_encode($is_liked, 15, 512) ?>" :prop-likes-count="<?php echo e($likes_count); ?>"></vue-like-icon>
        </div>

        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script type="module">

    $(function() {
        $('.js-deleteButton').on('click', function(e) {
            e.preventDefault();

            if (!window.confirm('本当に削除しますか？')) {
                return;
            }

            $('.js-deleteForm').submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/pages/show.blade.php ENDPATH**/ ?>