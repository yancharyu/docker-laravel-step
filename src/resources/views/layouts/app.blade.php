<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>@yield('title') | {{ __('おすすめ勉強法共有サービス「STEP」') }}</title>

    {{-- author --}}
    <meta name="author" content="STEP">

    {{-- keyword --}}
    <meta name="keyword" content="勉強, 学習, 勉強方法, プロセス, 共有">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- ヘッダー --}}

        <header id="header" class="l-header">
            <div class="p-header">
                <a href="{{ route('home') }}" class="p-header__logo"><img src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo.png') }} 1x, {{ asset('images/logo@2x.png') }} 2x"></a>

                {{-- ハンバーガーメニュー --}}
                <vue-sp-navi :is-login="{{ json_encode(Auth::check()) }}"></vue-sp-navi>

                <div class="p-header__navigation">
                    @guest
                    <a href="{{ route('login') }}" class="p-header__navItem">{{ __('ログイン') }}</a>
                    <a href="{{ route('register') }}" class="p-header__navItem">{{ __('新規登録') }}</a>
                    @endguest
                    @auth
                    <a href="{{ route('step.create') }}" class="p-header__navItem">
                        <i class="fas fa-pencil-alt"></i>
                        {{ __('新規投稿') }}
                    </a>
                    <a href="{{ route('step.index') }}" class="p-header__navItem">
                        <i class="far fa-clock"></i>
                        {{ __('タイムライン') }}
                    </a>
                    <a href="{{ route('mypage') }}" class="p-header__navItem">
                        <i class="fas fa-user"></i>
                        {{ __('マイページ') }}
                    </a>
                    @endauth
                </div>{{-- </.p-header__navigation> --}}
            </div>{{-- </.p-header> --}}
        </header>

        @include('components.flash')

        {{-- メイン --}}

        <main id="main">
            <div class="l-siteWidth">
                @yield('content')
            </div>{{-- </.l-siteWidth> --}}
        </main>

        {{-- フッター --}}

        <footer id="footer" class="l-footer">
            <div class="p-footer">
                <p class="p-footer__text">&#169; STEP. ALL RIGHTS RESERVED.</p>
            </div>{{-- </.p-footer> --}}
        </footer>
    </div>{{-- </#app> --}}

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')


</body>
</html>