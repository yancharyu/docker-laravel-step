
<?php if(Session::has('success_message')): ?>
<div class="p-flashMessage js-flashMessage">
    <?php echo e(Session::get('success_message')); ?>

</div>

<?php
// 一度表示したフラッシュメッセージは削除
Session::forget('success_message');
?>

<?php endif; ?>

<?php if(Session::has('all_clear')): ?>
<vue-modal>
    <template v-slot:title><?php echo e(__('全てのステージをクリアしました！')); ?></template>
    <template v-slot:button><?php echo e(__('閉じる')); ?></template>
</vue-modal>
<?php endif; ?><?php /**PATH /work/resources/views/components/flash.blade.php ENDPATH**/ ?>