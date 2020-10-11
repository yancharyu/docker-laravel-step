{{--
    必須slot
    $labelTitle =>  ラベルのタイトル
    $inputType  => type属性
    $inputName  => name属性

    任意slot
    $ipnutId     => name属性とIdを別の値にしたい時は指定（なければname属性と同じ値）
    $value       => データベースから値を渡すときに指定（編集画面など）
    $placeholder => プレースホルダー
--}}

<div class="c-form__item">
    <label for="{{ $inputId ?? $inputName }}">
        {{ __($labelTitle) }}

        <input type="{{ $inputType }}" name="{{ $inputName }}" id="{{ $inputId ?? $inputName }}" value="{{ isset($value) ? old($inputName, $value) : old($inputName) }}" class="c-input @error($inputName) c-input--error @enderror {{ $inputClassNames ?? '' }}" placeholder="{{ $placeholder ?? null }}" spellcheck="false" />
    </label>
    @error($inputName)
    <span class="u-require" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>