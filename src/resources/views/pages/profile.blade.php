@extends('layouts.app')

@section('title', __('プロフィール画面'))

@section('content')
<div class="p-profile">
    <div class="p-profile__sidebar">
        <img src="{{ $user->getUserProfilePic() }}" alt="" class="p-profile__pic">
        <p class="p-profile__name">{{ $user->name }}</p>
        {{ __('自己紹介') }}
        <div class="p-profile__introductionContainer">
            <p class="p-profile__introduction">{{ $user->introduction ?? __('自己紹介はありません') }}</p>
        </div>

        <vue-follow-button :user-id="{{ $user->id }}"></vue-follow-button>
        @if($is_followed)
        <p class="p-profile__followedMessage">フォローされています</p>
        @endif
    </div>

    <div class="p-profile__main">
        <h1 class="p-profile__title">{{ __('投稿一覧') }}</h1>
        @if ($user->steps->isNotEmpty())
        <vue-step-list :step-list="{{ $steps }}"></vue-step-list>
        @else
        <p class="p-profile__noSteps">{{ __('投稿はありません') }}</p>
        @endif
    </div>
</div>
@endsection