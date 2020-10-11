@extends('layouts.app')

@section('title', __('パスワード変更'))

@section('content')
<form action="{{ route('edit_password') }}" method="POST" class="c-form">
    @csrf
    <h1 class="c-form__title">{{ __('パスワード変更') }}</h1>

    <vue-password-input label-title="{{ __('現在のパスワード') }}" input-name="current_password" @error('current_password') error-message="{{ $message }}" @enderror></vue-password-input>

    <vue-password-input label-title="{{ __('新しいパスワード') }}" input-name="new_password" @error('new_password') error-message="{{ $message }}" @enderror></vue-password-input>

    <vue-password-input label-title="{{ __('パスワード確認用') }}" input-name="new_password_confirmation" @error('new_password_confirmation') error-message="{{ $message }}" @enderror></vue-password-input>

    @button(['btnClassNames' => 'c-btn--flRight'])
    @slot('btnText', '変更する')
    @endbutton


</form>
@endsection