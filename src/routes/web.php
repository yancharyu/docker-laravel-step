<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// リソースコントローラーのメソッド以外は全てシングルシングルアクションコントローラーに分割する

Route::get('/', 'ShowHomeController')->name('home');   // ホームページ
Auth::routes(['verify' => true]); // 認証ルート

Route::middleware(['auth', 'verified'])->group(function () { // authルート
    // Route::middleware(['auth'])->group(function () { // authルート
    // メール認証成功画面表示
    Route::get('verified', 'ShowVerifiedPageController')->name('verified');
    // 退会フォーム表示
    Route::get('withdraw', 'ShowWithdrawFormController')->name('showWithdrawForm');
    // 退会処理
    Route::post('withdraw', 'WithdrawController')->name('withdraw');
    // パスワード編集画面表示
    Route::get('edit-password', 'ShowEditPasswordFormController')->name('show_edit_password_form');
    // パスワード変更処理
    Route::post('edit-password', 'EditPasswordController')->name('edit_password');

    Route::prefix('step')->group(function () {   // ルートプリフィックス
        Route::name('step.')->group(function () {   // ルートネーム
            Route::middleware(['auth'])->group(function () {   // ルートミドルウェア

                // プロフィール画面表示
                Route::get('profile/{id}', 'ProfileController')->name('profile');

                // ステージ詳細
                Route::get('stage/{stage_id}', 'ShowStageController')->name('stage');
                // チャレンジ登録処理
                Route::post('challenge', 'StoreChallengeController')->name('challenge');

                // ステージクリア登録
                Route::post('achievement', 'StoreAchievementController')->name('achievement');
            });
        });
    });
    // マイページ表示
    Route::get('/mypage', 'ShowMypageController')->name('mypage');
    Route::get('/mypage/{any?}', 'ShowMypageController');
    Route::resource('step', 'StepController')->parameters(['step' => 'id']);  // リソースコントローラー
});
