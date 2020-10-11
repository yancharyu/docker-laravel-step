@extends('layouts.app')

@section('title', __('新規投稿'))

@section('content')

<form action="{{ route('step.store') }}" method="POST" class="c-form c-form--large">
    @csrf

    <h1 class="c-form__title">{{ __('STEP投稿') }}</h1>

    {{-- タイトル --}}
    @input
    @slot('labelTitle', 'タイトル')
    @slot('inputType', 'text')
    @slot('inputName', 'title')
    @slot('autofocus', true)
    @slot('placeholder', __('私が実践した英語の勉強法3ステップ'))
    @endinput

    {{-- カテゴリー選択 --}}
    <div class="c-form__item">
        <label for="category">
            {{ __('カテゴリー') }}
            <select name="category" id="category" class="c-selectBox @error('category') u-err @enderror">
                <option value="" @if(old('category')==='' ) selected @endif>{{ __('選択してください') }}</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if(old('category')==$category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        @error('category')
        <span class="u-require">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>{{-- </.c-form__item --}}

    {{-- 説明 --}}
    <vue-text-area label-title="{{ __('説明') }}" input-name="description" old-value="{{ old('description') }}" @error('description') error-message="{{ $message }}" @enderror></vue-text-area>

    {{-- ステージ登録 --}}
    <h2 class="p-top__subTitle">{{ __('ステージ登録') }}</h2>


    <div class="p-stageInput">
        <div class="js-stageInputWrapper">
            {{-- フォーム送信の値がなければ（初期の描画時）こっちを表示する --}}
            @empty(old('stages'))
            <div class="js-stageInput">
                {{ __('ステージ') }}1
                <div class="p-stageInput__container">

                    {{-- ステージタイトル --}}
                    <div class="c-form__item">
                        <label for="title0">
                            {{ __('タイトル') }}
                            <input type="text" name="stages[0][title]" id="title0" class="c-input js-stageInputTitle" spellcheck="false" placeholder="{{ __('まずは◯◯本を読もう！') }}" />
                        </label>
                    </div>{{-- </.c-form__item --}}
                    {{-- ステージ概要欄 --}}

                    <vue-text-area label-title="{{ __('概要') }}" input-name="stages[0][summary]" input-id="summary0" :cols="30" :rows="4"></vue-text-area>

                    {{-- ステージ目安時間 --}}
                    <div class="c-form__item">
                        <label for="time0">
                            {{ __('目安達成時間') }}
                            <input type="text" name="stages[0][time]" id="time0" class="c-input c-input--short js-stageInputTime" />
                            {{ __('時間') }}
                        </label>
                    </div>{{-- </.c-form__item> --}}

                </div>{{-- </.p-stageInput__container> --}}
            </div>{{-- </.js-stageInput --}}
            @else

            {{-- 一度でもPOST送信されていればこっちを表示する --}}
            @foreach(old('stages') as $val )

            <div class="js-stageInput">
                {{ __('ステージ'). $loop->iteration}}
                <div class="p-stageInput__container">

                    {{-- ステージタイトル --}}
                    <div class="c-form__item">
                        <label for="title{{ $loop->index }}">
                            {{ __('タイトル') }}
                            <input type="text" name="stages[{{ $loop->index }}][title]" id="title{{ $loop->index }}" class="c-input js-stageInputTitle @error('stages.'.$loop->index.'.title') c-input--error @enderror" spellcheck="false" value="{{ $val['title'] }}" />
                        </label>
                        @error('stages.'.$loop->index.'.title')
                        <span class="u-require">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>{{-- </.c-form__item> --}}

                    {{-- ステージ概要欄 --}}
                    <vue-text-area label-title="{{ __('概要') }}" input-name="stages[{{ $loop->index }}][summary]" old-value="{{ $val['summary'] }}" @error('stages.'.$loop->index.'.summary') error-message="{{ $message }}" @enderror :cols="30" :rows="4"></vue-text-area>

                    {{-- ステージ目安時間 --}}
                    <div class="c-form__item">
                        <label for="time{{ $loop->index }}">
                            {{ __('目安達成時間') }}
                            <input type="text" name="stages[{{ $loop->index }}][time]" id="time{{ $loop->index }}" class="c-input c-input--short js-stageInputTime @error('stages.'.$loop->index.'.time') c-input--error @enderror" value="{{ $val['time'] }}">
                            {{ __('時間') }}
                        </label>
                        @error('stages.'.$loop->index.'.time')
                        <span class="u-require">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>{{-- </.c-form__item> --}}

                </div>{{-- </.p-stageInput__container --}}
            </div>{{-- </.js-stageInput --}}
            @endforeach
            @endempty
        </div>{{-- </.p-stageInput__wrapper --}}

        {{-- エラーメッセージ --}}
        <p class="p-stageInput__errMessage js-stageInputErrMessage"></p>

        {{-- 追加ボタン & 削除ボタン --}}
        <button class="p-stageInput__button p-stageInput__button--primary c-form__item js-stageAddButton">＋ {{ __('ステージ追加') }}
        </button>
        <button class="p-stageInput__button p-stageInput__button--danger c-form__item js-stageDeleteButton">ー {{ __('ステージ削除') }}
        </button>

    </div>{{-- </.p-stageInput --}}

    @button(['btnClassNames' => 'c-btn--widthMax'])
    @slot('btnText', '投稿')
    @endbutton

</form>
@endsection

@section('script')
{{-- 新しいステージの追加処理 --}}
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
@endsection