@extends('layouts.app')

@section('title', __('ステージ詳細'))

@section('content')
<div class="p-stage">
    <div class="p-stage__main">

        <h1 class="p-stage__title">「 {{ $stage->title }} 」</h1>

        {{-- ひとつ前のステージがクリアできていれば概要を表示 --}}
        @if($is_before_stage_achievement)

        {{ __('概要') }}
        <div class="p-stage__summary">{{ $stage->summary ?? '概要はありません' }}</div>
        <p class="p-stage__time">{{ __('目安達成時間') }}： {{ $stage->time }}h</p>
        {{-- 既にクリア済みならクリア済みボタンを表示 --}}
        @if($is_achievement)
        <button class="c-btn c-btn--flRight c-btn--disabled p-stage__alClearButton">{{ __('クリア済み') }}</button>
        @else
        {{-- クリア済みでなければクリアボタンを表示 --}}
        <form action="{{ route('step.achievement') }}" method="POST">
            @csrf
            <input type="hidden" name="stage_id" :value="{{ $stage->id }}">
            <div class="c-btnContainer">
                <button class="c-btn c-btn--flRight p-stage__clearButton">{{ __('クリア！') }}</button>
            </div>
        </form>
        @endif
        @else
        {{-- 前のステージをクリアしていなければ概要欄は表示しない --}}
        <div class=" p-stage__noAchievement">{{ __('前のステージをクリアで開放') }}
        </div>
        @endif
    </div>{{-- </.p-stage__main --}}

    {{-- stage一覧サイドバー --}}
    <div class=" p-stageSidebar">
        <h1 class="p-stageSidebar__title">{{ __('ステージ一覧') }}</h1>
        @foreach($stages as $key => $item)
        <a href="{{ route('step.stage', $item->id) }}" class="c-stage @if($item->id === $stage->id) c-stage--isActive @endif">
            {{ __('ステージ') }}{{ $key + 1 }}
            <h2 class="c-stage__title">「{{ $item->title }}」</h2>
        </a>{{-- </.c-stage> --}}
        @endforeach
    </div>{{-- p-stageSidebar --}}
</div>{{-- </.p-stage --}}
@endsection