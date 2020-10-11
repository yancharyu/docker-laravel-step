@extends('layouts.app')

@section('title', __('ステップ詳細'))

@section('content')
<div class="p-show">
    <div class="p-show__head">
        <a href="{{ $step->canEdit($step->user_id) ? route('mypage') : route('step.profile', $step->user_id) }}" class="c-avatar">
            <img src="{{ $step->user->getUserProfilePic() }}" class="c-avatar__pic">
            <span class="c-avatar__username">{{ $step->user->name }}</span>
        </a>
        {{-- タイトル --}}
        <h1 class="p-show__title">「 {{ $step->title }} 」</h1>
        {{-- カテゴリー --}}
        <span class="p-show__category c-category">{{ $step->category->name }}</span>
        {{-- トータル目安達成時間 --}}
        {{-- getTotalClearTime -> app/helpers.phpに定義 --}}
        <div class="p-show__time">{{ __('トータル目安達成時間') }}： {{ getTotalClearTime($step->stages) }}h</div>
    </div>{{-- </.p-show__head --}}

    <div class="p-show__body">
        {{-- 説明欄 --}}
        <h2 class="p-show__subtitle c-textLine">{{ __('説明') }}</h2>
        <div class="p-show__description">{{ $step->description }}</div>

        {{-- ステージ一覧 --}}
        <h2 class="p-show__subtitle p-show__subtitle--txtCenter c-textLine">{{ __('ステージ一覧') }}</h2>
        <div class="p-show__stages">
            {{-- チャレンジ中かクリア済みでなければ表示させない --}}
            @if (!$is_challenge && !$is_cleared)
            <div class="p-show__overlay">
                <div class="p-show__lockMessage">{{ __('チャレンジを押して挑戦') }}</div>
            </div>
            @endif

            {{-- ステージ一覧リストレンダリング --}}
            @foreach($step->stages as $key => $stage)
            <a href="{{ route('step.stage', $stage->id) }}" class="c-stage p-show__stage">
                <h3 class="c-stage__title">
                {{ __('ステージ') }}{{ $key + 1 }}:
                「 {{ $stage->title }} 」
            </h3>{{-- </.c-stage__title --}}
            </a>{{-- </.c-stage --}}
            @endforeach
        </div>{{-- </.p-show__stages --}}
    </div>{{-- </.p-show__body --}}

    <div class="p-show__foot">
        {{-- Twitterシェアボタン --}}
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-text="あなたの人生のSTEPを共有しよう!&#010;他の人の勉強プロセスなどを共有しながら学習できるサービス「STEP」より共有しました！&#010;&#010;『{{ $step->title }}』&#010;" data-hashtags="STEP" data-size="large" rel="nofollow" target="_blank"></a>

        {{-- クリア済みならクリア済みボタンを表示 --}}
        <div class="p-show__btnContainer">
            @if($is_cleared)

            <button class="c-btn c-btn--show c-btn--disabled p-show__challengeButton--isClear">{{ __('クリア済み') }}</button>
            {{-- チャレンジ中ならチャレンジ中ボタンを表示 --}}
            @elseif($is_challenge)
            <button class="c-btn c-btn--show c-btn--disabled p-show__challengeButton--isChallenge">{{ __('チャレンジ中') }}</button>
            @else
            {{-- それ以外の場合はチャレンジボタンを表示 --}}
            <form action="{{ route('step.challenge') }}" method="POST">
                @csrf
                <input type="hidden" name="step_id" value="{{ $step->id }}">
                <button class="c-btn c-btn--show p-show__challengeButton">{{ __('チャレンジ') }}</button>
            </form>
            @endif
        </div>{{-- </.p-show__btnContainer> --}}
    </div>{{-- </.p-show__foot --}}

    <div class="p-show__iconContainer">

        {{-- 編集可能な場合は編集アイコンと削除アイコンを表示 --}}
        @if ($step->canEdit($step->user_id))
        <div class="p-show__iconItem">
            <vue-like-icon :user-id="{{ $user_id }}" :step-id="{{ $step->id }}" :prop-is-liked="@json($is_liked)" :prop-likes-count="{{ $likes_count }}"></vue-like-icon>
        </div>
        <a href="{{ route('step.edit', $step->id) }}" class="p-show__iconItem"><i class="far fa-edit"></i>{{ __('編集') }}</a>
        <span class="js-deleteButton p-show__iconItem"><i class="far fa-trash-alt"></i>{{ __('削除') }}</span>
        <form action="{{ route('step.destroy', $step->id) }}" class="u-dispNone js-deleteForm" method="POST">
            @csrf
            @method('DELETE')
        </form>
        @else
        <div class="p-show__iconItem p-show__iconItem--widthMax">
            <vue-like-icon :user-id="{{ $user_id }}" :step-id="{{ $step->id }}" :prop-is-liked="@json($is_liked)" :prop-likes-count="{{ $likes_count }}"></vue-like-icon>
        </div>

        @endif
    </div>{{-- </.p-show__iconContainer> --}}

</div>{{-- </.p-show --}}
@endsection

@section('script')
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script type="module">

    $(function() {
        $('.js-deleteButton').on('click', function(e) {
            e.preventDefault();

            if (!window.confirm('本当に削除しますか？')) {
                return;
            }

            $('.js-deleteForm').submit();
        });
    });
</script>
@endsection