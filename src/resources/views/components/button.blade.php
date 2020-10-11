{{--
    必須slot
    $btnText =>  ボタンのテキスト

    任意slot
    $type           => 指定がなければsubmit

    $btnClassNames  => ボタンにクラスを追加で渡したい時は連想配列の形で渡す
    （例）
    @button(['btnClassNames' => 'c-btn--flRight'])
    @slot()
    @endbutton

    複数渡したい時は空白繋ぎで渡す
    （例）
    @button(['btnClassNames' => 'c-btn--flRight aiueo btn example'])
    @slot()
    @endbutton
--}}

<div class="c-btnContainer c-form__item">

    {{-- $type指定がなければsubmitにする --}}
    <button type="{{ $type ?? 'submit' }}" class="c-btn {{ $btnClassNames ?? '' }}">
        {{ __($btnText) }}
    </button>
</div>