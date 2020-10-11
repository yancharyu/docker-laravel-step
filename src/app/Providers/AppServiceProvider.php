<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // コンポーネントエイリアス
        Blade::component('components.input', 'input');
        Blade::component('components.button', 'button');
        Blade::component('components.checkbox', 'checkbox');
        Blade::component('components.textarea', 'textarea');
        Blade::component('components.step', 'step');

        // varchar型の文字数を191に制限
        Schema::defaultStringLength(191);

        // httpsを強制
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
