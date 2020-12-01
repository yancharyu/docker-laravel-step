<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title><?php echo e(__('おすすめ勉強法共有サービス「STEP」')); ?></title>
    
    <link rel="shortcut icon" href="<?php echo e(asset('icons/favicon.ico')); ?>">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">

        
        <header id="header" class="l-header">
            <div class="p-header">
                <a href="<?php echo e(route('home')); ?>" class="p-header__logo"><img src="<?php echo e(asset('images/logo.png')); ?>" srcset="<?php echo e(asset('images/logo.png')); ?> 1x, <?php echo e(asset('images/logo@2x.png')); ?> 2x"></a>
                <vue-sp-navi :is-login="<?php echo e(json_encode(Auth::check())); ?>"></vue-sp-navi>
                <div class="p-header__navigation">
                    <a href="<?php echo e(route('login')); ?>" class="p-header__navItem"><?php echo e(__('ログイン')); ?></a>
                    <a href="<?php echo e(route('register')); ?>" class="p-header__navItem"><?php echo e(__('新規登録')); ?></a>
                </div>
            </div>
        </header>

        
        <div class="p-home__heroImg"></div>
        <div class="p-home__container">
            <div class="p-home__about">

                <h1 class="p-home__title"><?php echo e(__('「STEP」とは？')); ?></h1>
                <p class="p-home__mainText">
                    <?php echo e(__('何かの勉強をする際、人それぞれ「これが良かった」という「順番」と「内容」があります。')); ?>

                    <br>
                    <?php echo e(__('人それぞれの「この順番でこういったものを学んでいったのが良かった」という勉強過程「STEP」を投稿し、他の人はその「STEP」を参考に学習を進めていけるサービスです。')); ?>

                </p>
            </div>
        </div>
        <div class="p-home__container">
            <h1 class="p-home__title"><?php echo e(__('自分のSTEPを投稿する')); ?></h1>
            <div class="p-home__post">
                <p><i class="fas fa-book p-home__postIcon p-home__postIcon--book"></i><?php echo e(__('カテゴリーを設定して投稿できる')); ?></p>
                <p><i class="fas fa-walking p-home__postIcon p-home__postIcon--human"></i><?php echo e(__('STEPに勉強段階のステージを追加できる')); ?></p>
                <p><i class="fas fa-hourglass-start p-home__postIcon p-home__postIcon--hourglass"></i><?php echo e(__('それぞれの学習STEPに目安達成時間を設定しよう')); ?></p>

            </div>
        </div>
        <div class="p-home__container">
            <div class="p-home__example">
                <h1 class="p-home__title">「STEP」<?php echo e(__('でできること')); ?></h1>
                <p><?php echo e(__('カテゴリー、キーワード毎に検索できる')); ?></p>
                <p><?php echo e(__('チャレンジ中のSTEPの進捗をマイページから確認できる')); ?></p>
                <p><?php echo e(__('よかったSTEPはTwitterでシェアしよう！')); ?></p>
            </div>
        </div>
        <div class="p-home__container p-home__auth">
            <h1 class="p-home__title"><?php echo e(__('新規登録して学習を始めよう')); ?></h1>
            <button class="c-btn p-home__registerButton">
                <a href="<?php echo e(route('register')); ?>">
                    新規登録
                </a>
            </button>
        </div>

    </div>

    
    <footer id="footer" class="l-footer">
        <div class="p-footer">
            <p class="p-footer__text">&#169; STEP. ALL RIGHTS RESERVED.</p>
        </div>
    </footer>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
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

</html><?php /**PATH /work/resources/views/pages/home.blade.php ENDPATH**/ ?>