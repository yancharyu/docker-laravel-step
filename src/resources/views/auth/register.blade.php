@extends('layouts.app')

@section('title', __('ユーザー登録'))

@section('content')
<form action="{{ route('register') }}" method="POST" class="c-form">
    @csrf

    <h1 class="c-form__title">{{ __('新規登録') }}</h1>

    @input
    @slot('labelTitle', 'ユーザーネーム(30文字以内)')
    @slot('inputType', 'text')
    @slot('inputName', 'name')
    @endinput

    @input
    @slot('labelTitle', 'メールアドレス')
    @slot('inputType', 'text')
    @slot('inputName', 'email')
    @endinput

    <vue-password-input label-title="パスワード" input-name="password" @error('password') error-message="{{ $message }}" @enderror></vue-password-input>

    <vue-password-input label-title="パスワード(確認用)" input-name="password_confirmation"></vue-password-input>

    @button(['btnClassNames' => 'c-btn--flRight'])
    @slot('btnText', '新規登録')
    @endbutton

</form>
@endsection