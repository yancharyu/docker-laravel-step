<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {

    Route::get('step', 'Api\ApiGetStepController'); // ステップ一覧
    Route::get('categories', 'Api\ApiGetCategoriesController'); // カテゴリー一覧
    Route::get('likes', 'Api\ApiGetLikesCountController'); // お気に入り一覧
    Route::post('likes', 'Api\ApiToggleLikesController'); // お気に入り切り替え
    Route::get('follow', 'Api\ApiGetIsFollowController'); // 既にフォローしているかどうか取得
    Route::post('follow', 'Api\ApiToggleFollowController'); // フォロー状態切り替え
    Route::get('user', 'Api\ApiGetUserController'); // ログイン中のユーザー情報取得
    Route::post('edit_profile', 'Api\ApiEditProfileController'); // プロフィール編集処理
    Route::get('my-steps', 'Api\ApiGetMyStepsController'); // 自分の全てのステップ取得
    Route::get('challenges', 'Api\ApiGetChallengeStepsController'); // チャレンジ中ステップ取得
    Route::get('like-steps', 'Api\ApiGetLikeStepsController'); // お気に入りステップ取得
    Route::get('clears', 'Api\ApiGetClearStepsController'); // クリア済みステップ取得
    Route::get('followings', 'Api\ApiGetFollowingsController'); // クリア済みステップ取得
    Route::get('followers', 'Api\ApiGetFollowersController'); // クリア済みステップ取得
});
