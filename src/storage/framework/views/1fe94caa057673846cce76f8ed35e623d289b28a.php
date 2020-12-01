<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(__('おすすめ勉強法共有サービス「STEP」')); ?></title>

    
    <meta name="author" content="STEP">

    
    <meta name="keyword" content="勉強, 学習, 勉強方法, プロセス, 共有">

    
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
                    <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="p-header__navItem"><?php echo e(__('ログイン')); ?></a>
                    <a href="<?php echo e(route('register')); ?>" class="p-header__navItem"><?php echo e(__('新規登録')); ?></a>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('step.create')); ?>" class="p-header__navItem">
                        <i class="fas fa-pencil-alt"></i>
                        <?php echo e(__('新規投稿')); ?>

                    </a>
                    <a href="<?php echo e(route('step.index')); ?>" class="p-header__navItem">
                        <i class="far fa-clock"></i>
                        <?php echo e(__('タイムライン')); ?>

                    </a>
                    <a href="<?php echo e(route('mypage')); ?>" class="p-header__navItem">
                        <i class="fas fa-user"></i>
                        <?php echo e(__('マイページ')); ?>

                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <?php echo $__env->make('components.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        

        <main id="main">
            <div class="l-siteWidth">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>

        

        <footer id="footer" class="l-footer">
            <div class="p-footer">
                <p class="p-footer__text">&#169; STEP. ALL RIGHTS RESERVED.</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>


</body>
</html><?php /**PATH /work/resources/views/layouts/app.blade.php ENDPATH**/ ?>