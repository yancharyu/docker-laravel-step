@extends('layouts.app')

@section('title', __('トップページ'))

@section('content')
{{-- 新規作成ICON読み込み --}}
@include('components.create_icon')
<div class="p-top">
    <div class="p-top__title">{{ __('STEP一覧') }}</div>
    <vue-step></vue-step>
</div>
@endsection