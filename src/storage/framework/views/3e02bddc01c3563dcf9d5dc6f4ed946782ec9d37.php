<?php $__env->startSection('title', __('新規投稿')); ?>

<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('step.store')); ?>" method="POST" class="c-form c-form--large">
    <?php echo csrf_field(); ?>

    <h1 class="c-form__title"><?php echo e(__('STEP投稿')); ?></h1>

    
    <?php $__env->startComponent('components.input'); ?>
    <?php $__env->slot('labelTitle', 'タイトル'); ?>
    <?php $__env->slot('inputType', 'text'); ?>
    <?php $__env->slot('inputName', 'title'); ?>
    <?php $__env->slot('autofocus', true); ?>
    <?php $__env->slot('placeholder', __('私が実践した英語の勉強法3ステップ')); ?>
    <?php echo $__env->renderComponent(); ?>

    
    <div class="c-form__item">
        <label for="category">
            <?php echo e(__('カテゴリー')); ?>

            <select name="category" id="category" class="c-selectBox <?php if ($errors->has('category')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('category'); ?> u-err <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                <option value="" <?php if(old('category')==='' ): ?> selected <?php endif; ?>><?php echo e(__('選択してください')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if(old('category')==$category->id): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </label>
        <?php if ($errors->has('category')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('category'); ?>
        <span class="u-require">
            <strong><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    </div>

    
    <vue-text-area label-title="<?php echo e(__('説明')); ?>" input-name="description" old-value="<?php echo e(old('description')); ?>" <?php if ($errors->has('description')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('description'); ?> error-message="<?php echo e($message); ?>" <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>></vue-text-area>

    
    <h2 class="p-top__subTitle"><?php echo e(__('ステージ登録')); ?></h2>


    <div class="p-stageInput">
        <div class="js-stageInputWrapper">
            
            <?php if(empty(old('stages'))): ?>
            <div class="js-stageInput">
                <?php echo e(__('ステージ')); ?>1
                <div class="p-stageInput__container">

                    
                    <div class="c-form__item">
                        <label for="title0">
                            <?php echo e(__('タイトル')); ?>

                            <input type="text" name="stages[0][title]" id="title0" class="c-input js-stageInputTitle" spellcheck="false" placeholder="<?php echo e(__('まずは◯◯本を読もう！')); ?>" />
                        </label>
                    </div>
                    

                    <vue-text-area label-title="<?php echo e(__('概要')); ?>" input-name="stages[0][summary]" input-id="summary0" :cols="30" :rows="4"></vue-text-area>

                    
                    <div class="c-form__item">
                        <label for="time0">
                            <?php echo e(__('目安達成時間')); ?>

                            <input type="text" name="stages[0][time]" id="time0" class="c-input c-input--short js-stageInputTime" />
                            <?php echo e(__('時間')); ?>

                        </label>
                    </div>

                </div>
            </div>
            <?php else: ?>

            
            <?php $__currentLoopData = old('stages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="js-stageInput">
                <?php echo e(__('ステージ'). $loop->iteration); ?>

                <div class="p-stageInput__container">

                    
                    <div class="c-form__item">
                        <label for="title<?php echo e($loop->index); ?>">
                            <?php echo e(__('タイトル')); ?>

                            <input type="text" name="stages[<?php echo e($loop->index); ?>][title]" id="title<?php echo e($loop->index); ?>" class="c-input js-stageInputTitle <?php if ($errors->has('stages.'.$loop->index.'.title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stages.'.$loop->index.'.title'); ?> c-input--error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" spellcheck="false" value="<?php echo e($val['title']); ?>" />
                        </label>
                        <?php if ($errors->has('stages.'.$loop->index.'.title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stages.'.$loop->index.'.title'); ?>
                        <span class="u-require">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>

                    
                    <vue-text-area label-title="<?php echo e(__('概要')); ?>" input-name="stages[<?php echo e($loop->index); ?>][summary]" old-value="<?php echo e($val['summary']); ?>" <?php if ($errors->has('stages.'.$loop->index.'.summary')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stages.'.$loop->index.'.summary'); ?> error-message="<?php echo e($message); ?>" <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?> :cols="30" :rows="4"></vue-text-area>

                    
                    <div class="c-form__item">
                        <label for="time<?php echo e($loop->index); ?>">
                            <?php echo e(__('目安達成時間')); ?>

                            <input type="text" name="stages[<?php echo e($loop->index); ?>][time]" id="time<?php echo e($loop->index); ?>" class="c-input c-input--short js-stageInputTime <?php if ($errors->has('stages.'.$loop->index.'.time')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stages.'.$loop->index.'.time'); ?> c-input--error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e($val['time']); ?>">
                            <?php echo e(__('時間')); ?>

                        </label>
                        <?php if ($errors->has('stages.'.$loop->index.'.time')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('stages.'.$loop->index.'.time'); ?>
                        <span class="u-require">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        
        <p class="p-stageInput__errMessage js-stageInputErrMessage"></p>

        
        <button class="p-stageInput__button p-stageInput__button--primary c-form__item js-stageAddButton">＋ <?php echo e(__('ステージ追加')); ?>

        </button>
        <button class="p-stageInput__button p-stageInput__button--danger c-form__item js-stageDeleteButton">ー <?php echo e(__('ステージ削除')); ?>

        </button>

    </div>

    <?php $__env->startComponent('components.button', ['btnClassNames' => 'c-btn--widthMax']); ?>
    <?php $__env->slot('btnText', '投稿'); ?>
    <?php echo $__env->renderComponent(); ?>

</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="module">
    $(function () {

        // ステージ入力欄を追加する
        // 追加ボタンが押された時の処理
        $('.js-stageAddButton').on('click', function (e) {
        e.preventDefault();

        const inputNum = $('.js-stageInput').length; // 現在のステージの数
        const newInputNum = inputNum + 1; // ラベル用の数字
        const lastInputTitle = $('.js-stageInput:last').find('.js-stageInputTitle').val(); // 最後のステージのタイトルの値
        const lastInputTime = $('.js-stageInput:last').find('.js-stageInputTime').val(); // 最後のステージの目安時間の値
        const errMsg = $('.js-stageInputErrMessage'); // エラーメッセ
        // 直前のタイトルと目安時間が未入力の場合新しいinputを追加できないようにする
        if (!lastInputTitle) {
        errMsg.text(i18n.tc('message.ステージのタイトルを入力してください'));
        return;
        }

        if (!lastInputTime) {
        errMsg.text(i18n.tc('message.ステージの目安時間を入力してください'));
        return;
        }

        // // バリデーションオッケーの場合エラーメッセージをリセット
        errMsg.text('');


        // 新しいステージinputを生成
        const newInput = `
        <div class="js-stageInput">
            ${i18n.tc('message.ステージ')}${newInputNum}
            <div class="p-stageInput__container">
                <div class="c-form__item">
                    <label for="title${inputNum}">
                        ${i18n.tc('message.タイトル')}
                        <input type="text" name="stages[${inputNum}][title]" id="title${inputNum}" class="c-input js-stageInputTitle" spellcheck="false" />
                    </label>
                </div>

                <div id="new_textarea${inputNum}">アイウエオ</div>

                <div class="c-form__item">
                    <label for="time${inputNum}">
                        ${i18n.tc('message.目安達成時間')}
                        <input type="text" name="stages[${inputNum}][time]" id="time${inputNum}" class="c-input c-input--short js-stageInputTime" />
                        ${i18n.tc('message.時間')}
                    </label>
                </div>
            </div>
            `;

            // // タグを追加
            $('.js-stageInputWrapper').append(newInput);

            // textareaのvueコンポーネントを動的生成
            const TextAreaComponent = Vue.extend(TextArea);
            const textArea = new TextAreaComponent({
                propsData: {
                    labelTitle: '概要',
                    inputName: `stages[${inputNum}][summary]`,
                    inputId: `summary${inputNum}`,
                    cols: 30,
                    rows: 4
                },
                // この記述がないとエラーになってしまう！
                i18n
            });

            // さっき追加したnew_textareaタグにマウント
            textArea.$mount(`#new_textarea${inputNum}`);
        });

            // 削除ボタンが押された時の処理
        $('.js-stageDeleteButton').on('click', function (e) {
            e.preventDefault();

            const inputNum = $('.js-stageInput').length; // 現在のステージの数
            const errMsg = $('.js-stageInputErrMessage'); // エラーメッセ

            // ステージが１つの状態で削除ボタンが押されたときはエラーにする
            if (inputNum <= 1) {
                errMsg.text(i18n.tc('message.ステージは１つ以上登録してください'));
                return;
            }

            // そうでなければエラーメッセージを空にしてステージを削除する
            errMsg.text('');
            $('.js-stageInput:last').remove();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/pages/create.blade.php ENDPATH**/ ?>