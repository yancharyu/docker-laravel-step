

<div class="c-form__item">
    <label for="<?php echo e($inputId ?? $inputName); ?>">
        <?php echo e(__($labelTitle)); ?>


        <input type="<?php echo e($inputType); ?>" name="<?php echo e($inputName); ?>" id="<?php echo e($inputId ?? $inputName); ?>" value="<?php echo e(isset($value) ? old($inputName, $value) : old($inputName)); ?>" class="c-input <?php if ($errors->has($inputName)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($inputName); ?> c-input--error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?> <?php echo e($inputClassNames ?? ''); ?>" placeholder="<?php echo e($placeholder ?? null); ?>" spellcheck="false" />
    </label>
    <?php if ($errors->has($inputName)) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first($inputName); ?>
    <span class="u-require" role="alert">
        <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
</div><?php /**PATH /work/resources/views/components/input.blade.php ENDPATH**/ ?>