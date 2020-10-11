@extends('layouts.app')

@section('title', __('エラーページ'))

@section('content')

<div class="p-errorPage">
    <h1 class="p-errorPage__head">{{ $status_code }}</h1>
    <br>
    <p class="p-errorPage__body">{{ $status_code === 500 ? 'INTERNAL SERVER ERROR' : 'PAGE NOT FOUND' }}</p>
    <br>
    <p class="p-errorPage__foot">{{ $message }}</p>
    <a href="{{ route('step.index') }}" class="p-errorPage__link">
        &laquo;{{ __('TOP') }}</a>
</div>{{-- </.p-errorPage> --}}
@endsection