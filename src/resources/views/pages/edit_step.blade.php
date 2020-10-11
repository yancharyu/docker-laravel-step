@extends('layouts.app')

@section('title', __('ステップ編集'))

@section('content')

<form action="{{ route('step.update', $step->id) }}" method="POST" class="c-form c-form--large">
    @csrf
    @method('PATCH')

    <h1 class="c-form__title">{{ __('STEP編集') }}</h1>

    {{-- タイトル --}}
    @input
    @slot('labelTitle', 'タイトル')
    @slot('inputType', 'text')
    @slot('inputName', 'title')
    @slot('value', $step->title)
    @endinput

    {{-- カテゴリー --}}
    <div class="c-form__item">
        <label for="category">
            {{ __('カテゴリー') }}
            <select name="category" id="category" class="c-selectBox @error('category') u-err @enderror">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if(old('category',$step->category->id) === $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        @error('category')
        <span class="u-require">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>{{-- </.c-form__item --}}

    {{-- 説明欄 --}}
    @textarea
    @slot('labelTitle', '説明')
    @slot('inputName', 'description')
    @slot('rows', 10)
    @slot('value', $step->description)
    @endtextarea

    {{-- ステージ編集 --}}
    <h2 class="p-top__subTitle">{{ __('ステージ登録（最大10個）') }}</h2>


    <div class="p-stageInput">
        <div class="p-stageInput__wrapper">
            @foreach($step->stages as $stage )

            {{ __('ステージ'). $loop->iteration}}
            <div class="p-stageInput__container">

                {{-- ステージタイトル --}}
                <div class="c-form__item">
                    <label for="title{{ $loop->index }}">
                        {{ __('タイトル') }}
                        <input type="text" name="stages[{{ $loop->index }}][title]" id="title{{ $loop->index }}" class="c-input @error('stages.'.$loop->index.'.title') c-input--error @enderror" spellcheck="false" value="{{ $stage['title'] }}" />
                    </label>
                    @error('stages.'.$loop->index.'.title')
                    <span class="u-require">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>{{-- </.c-form__item> --}}

                {{-- ステージ概要欄 --}}
                <vue-text-area label-title="{{ __('概要') }}" input-name="stages[{{ $loop->index }}][summary]" input-id="summary[{{ $loop->index }}]" old-value="{{ $stage['summary'] }}" @error('stages.'.$loop->index.'.summary') error-message="{{ $message }}" @enderror :cols="30" :rows="4"></vue-text-area>

                {{-- ステージ目安時間 --}}
                <div class="c-form__item">
                    <label for="time{{ $loop->index }}">
                        {{ __('目安達成時間') }}
                        <input type="text" name="stages[{{ $loop->index }}][time]" id="time{{ $loop->index }}" class="c-input c-input--short @error('stages'.$loop->index.'.time') c-input--error @enderror" value="{{ $stage['time'] }}">
                        {{ __('時間') }}
                    </label>
                    @error('stages.'.$loop->index.'.time')
                    <span class="u-require">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>{{-- </.c-form__item> --}}

            </div>{{-- </.p-stageInput__container --}}
            @endforeach
        </div>{{-- </.p-stageInput__wrapper --}}
    </div>{{-- </.p-stageInput --}}

    @button(['btnClassNames' => 'c-btn--widthMax'])
    @slot('btnText', '登録')
    @endbutton

</form>
@endsection