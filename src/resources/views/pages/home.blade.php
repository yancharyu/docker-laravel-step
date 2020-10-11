<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title --}}
    <title>{{ __('おすすめ勉強法共有サービス「STEP」') }}</title>
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
                <vue-sp-navi :is-login="{{ json_encode(Auth::check()) }}"></vue-sp-navi>
                <div class="p-header__navigation">
                    <a href="{{ route('login') }}" class="p-header__navItem">{{ __('ログイン') }}</a>
                    <a href="{{ route('register') }}" class="p-header__navItem">{{ __('新規登録') }}</a>
                </div>{{-- </.p-header__navigation> --}}
            </div>{{-- </.p-header> --}}
        </header>

        {{-- メイン --}}
        <div class="p-home__heroImg"></div>
        <div class="p-home__container">
            <div class="p-home__about">

                <h1 class="p-home__title">{{ __('「STEP」とは？') }}</h1>
                <p class="p-home__mainText">
                    {{ __('何かの勉強をする際、人それぞれ「これが良かった」という「順番」と「内容」があります。') }}
                    <br>
                    {{ __('人それぞれの「この順番でこういったものを学んでいったのが良かった」という勉強過程「STEP」を投稿し、他の人はその「STEP」を参考に学習を進めていけるサービスです。') }}
                </p>
            </div>
        </div>
        <div class="p-home__container">
            <h1 class="p-home__title">{{ __('自分のSTEPを投稿する') }}</h1>
            <div class="p-home__post">
                <p><i class="fas fa-book p-home__postIcon p-home__postIcon--book"></i>{{ __('カテゴリーを設定して投稿できる') }}</p>
                <p><i class="fas fa-walking p-home__postIcon p-home__postIcon--human"></i>{{ __('STEPに勉強段階のステージを追加できる') }}</p>
                <p><i class="fas fa-hourglass-start p-home__postIcon p-home__postIcon--hourglass"></i>{{ __('それぞれの学習STEPに目安達成時間を設定しよう') }}</p>

            </div>
        </div>
        <div class="p-home__container">
            <div class="p-home__example">
                <h1 class="p-home__title">「STEP」{{ __('でできること') }}</h1>
                <p>{{ __('カテゴリー、キーワード毎に検索できる') }}</p>
                <p>{{ __('チャレンジ中のSTEPの進捗をマイページから確認できる') }}</p>
                <p>{{ __('よかったSTEPはTwitterでシェアしよう！') }}</p>
            </div>
        </div>
        <div class="p-home__container p-home__auth">
            <h1 class="p-home__title">{{ __('新規登録して学習を始めよう') }}</h1>
            <button class="c-btn p-home__registerButton">
                <a href="{{ route('register') }}">
                    新規登録
                </a>
            </button>
        </div>

    </div>

    {{-- フッター --}}
    <footer id="footer" class="l-footer">
        <div class="p-footer">
            <p class="p-footer__text">&#169; STEP. ALL RIGHTS RESERVED.</p>
        </div>{{-- </.p-footer> --}}
    </footer>
    </div>{{-- </#app> --}}

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('a[href^=#]').click(function(){
                const speed = 500;
                const href = $(this).attr("href");
                const target = $(href == "#" || href == "" ? 'html' : href);
                const position = target.offset().top;
                $("html, body").animate({scrollTop:position}, speed, "swing");
                return false;
            });
        });
    </script>
</body>

</html>