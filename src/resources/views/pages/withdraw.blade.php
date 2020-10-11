@extends('layouts.app')

@section('title', __('退会フォーム'))

@section('content')

<div class="p-withdraw">

    <h1 class="p-withdraw__title">{{ __('退会手続き') }}</h1>
    <div class="p-withdraw__body">

        <i class="fas fa-exclamation-triangle p-withdraw__triangle">
            本当に退会しますか？
        </i>
        <p class="p-withdraw__mainText">
            {{ __('今までの投稿やチャレンジ記録などは全て削除され、二度と復元できなくなります。') }}
        </p>
    </div>{{-- </.p-withdraw__body> --}}
    <a class="c-btn p-withdraw__button p-withdraw__button--mgBottom" href="{{ route('mypage') }}">{{ __('マイページへ') }}</a>
    <form action="{{ route('withdraw') }}" method="POST">
        @csrf
        <button class="c-btn p-withdraw__button p-withdraw__button--danger">{{ __('退会する') }}</button>
    </form>

    <form action="{{ route('withdraw') }}" method="POST">
        @csrf

    </form>
</div>{{-- </.p-mypage__content --}}
</div>{{-- </.p-mypage> --}}
@endsection