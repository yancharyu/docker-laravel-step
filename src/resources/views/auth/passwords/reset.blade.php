@extends('layouts.app')

@section('title', __('パスワードリセット'))

@section('content')
<form action="{{ route('password.update') }}" method="POST" class="c-form">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <h1 class="c-form__title">{{ __('パスワード再設定') }}</h1>

    @input
    @slot('inputName', 'email')
    @slot('labelTitle', 'メールアドレス')
    @slot('inputType', 'text')
    @slot('autofocus', true)
    @endinput

    <vue-password-input label-title="新しいパスワード" input-name="password" @error('password') error-message="{{ $message }}" @enderror></vue-password-input>


    <vue-password-input label-title="新しいパスワード(確認用)" input-name="password_confirmation"></vue-password-input>

    @button(['btnClassNames' => 'c-btn--flRight'])
    @slot('btnText', '変更する')
    @endbutton

</form>
@endsection