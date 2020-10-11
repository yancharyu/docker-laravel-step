@extends('layouts.app')

@section('title', __('認証成功'))

@section('content')
<div class="p-verified">
    <h1 class="p-verified__title">Welcome!!</h1>
    <i class="fas fa-check-square p-verified__check-square">
    </i>
    <span class="p-verified__subTitle">
        {{ __('メールアドレスの認証に成功しました') }}
    </span>
    <a href="{{ route('step.index') }}" class="c-btn c-btn--primary p-verified__link">{{ __('さっそく始めましょう！') }}</a>
</div>
@endsection