{{--
    必須slot
    $labelTitle =>  ラベルのタイトル
    $inputName  => name属性

    任意slot
    $ipnutId     => name属性とIdを別の値にしたい時は指定（なければname属性と同じ値）
    $cols        => textareaの縦幅（デフォルトは30）
    $rows        => textareaの横幅（デフォルトは10）
    $value       => データベースから値を渡すときに指定（編集画面など）
    $placeholder => プレースホルダー
--}}


<div class="c-form__item">

    <label for="{{ $inputId ?? $inputName }}">
        {{ $labelTitle }}
        <textarea name="{{ $inputName }}" id="{{ $inputId ?? $inputName }}" cols="{{ $cols ?? 40 }}" rows="{{ $rows ?? 10 }}" class="c-textarea @error($inputName) u-err @enderror" placeholder="{{ $placeholder ?? null }}">{{ isset($value) ? old($inputName, $value) : old($inputName) }}</textarea>
    </label>

    @error($inputName)
    <span class="u-require">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>{{-- </.c-form__item> --}}