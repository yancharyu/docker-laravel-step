@extends('layouts.app')

@section('title', __('メール認証'))

@section('content')
<div class="p-verifyEmail">

    <div class="p-verifyEmail__head">{{ __('メールアドレスの認証') }}</div>

    <div class="p-verifyEmail__body">

        {{-- メールが再送信されたことを通知する --}}
        @if (session('resent'))
        <div class="p-verifyEmail__body p-verifyEmail__body--success" role="alert">
            {{ __('メールが送信されました！') }}
        </div>
        @endif

        <p>{{ __('あなたのメールアドレス宛にメールが送信されました。') }}</p>
        <br>
        <p>{{ __('メール内リンクからメールアドレス認証を完了してください') }}</p>
        <br>
        <p>
            {{ __('メールが届いていない場合は') }}
            <a href="{{ route('verification.resend') }}" class="p-verifyEmail__link">{{ __('こちらをクリックしてください') }}</a>
        </p>
    </div>
    <a class="p-verifyEmail__link p-verifyEmail__link--logout" onclick="event.preventDefault(); document.getElementById('form_logout').submit();">&laquo; {{ __('ログアウト') }}</a>

    <form id="form_logout" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>

</div>
@endsection