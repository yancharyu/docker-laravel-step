@extends('layouts.app')

@section('title', __('マイページ'))

@section('content')

{{-- <div class="p-mypage__overlay js-mypageOverlay"></div> --}}

{{-- 新規作成ICON読み込み --}}
@include('components.create_icon')

<vue-mypage :user="{{ $user }}"></vue-mypage>

@endsection