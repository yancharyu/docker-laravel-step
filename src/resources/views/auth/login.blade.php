@extends('layouts.app')

@section('title', __('ログイン'))

@section('content')
<form action="{{ route('login') }}" method="POST" class="c-form">
    @csrf

    <h1 class="c-form__title">{{ __('ログイン') }}</h1>
    @input
    @slot('labelTitle', 'メールアドレス')
    @slot('inputType', 'text')
    @slot('inputName', 'email')
    @endinput

    <vue-password-input label-title="{{ __('パスワード') }}" input-name="password" @error('password') error-message="{{ $message }}" @enderror></vue-password-input>

    @checkbox
    @slot('inputName', 'remember')
    @slot('labelTitle', 'ログイン情報を保存')
    @endcheckbox

    @button(['btnClassNames' => 'c-btn--flRight'])
    @slot('btnText', 'ログイン')
    @endbutton

    @if (Route::has('password.request'))
    <a class="c-form__item c-form__link" href="{{ route('password.request') }}">
        {{ __('パスワードをお忘れですか？') }}
    </a>
    @endif


</form>
@endsection