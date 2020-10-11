@extends('layouts.app')

@section('title', __('リセットメール送信フォーム'))

@section('content')

<div class="p-passwordReset">
    <div class="p-passwordReset__head">{{ __('パスワードリセット') }}</div>


    <form method="POST" action="{{ route('password.email') }}" class="p-passwordReset__form">
        @csrf

        {{-- メールが送信されたことを通知するメッセージ --}}
        @if (session('status'))
        <div class="p-passwordReset__status">
            {{ session('status') }}
        </div>
        @endif

        @input
        @slot('inputName', 'email')
        @slot('labelTitle','メールアドレスを入力してください')
        @slot('inputType', 'text')
        @slot('autofocus',true)
        @endinput

        @button(['btnClassNames' => 'c-btn--flRight'])
        @slot('btnText', '送信する')
        @endbutton
    </form>
</div>

@endsection