<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EditProfileRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiEditProfileController extends Controller
{
    /**
     * プロフィール変更処理を行い、新しいユーザー情報をJSON形式で返す
     *
     * @param  \Illuminate\Http\Request プロフィール変更フォームのオブジェクト
     * @return \Illuminate\Http\Response ユーザー情報
     */
    public function __invoke(EditProfileRequest $request): JsonResponse
    {
        $user = Auth::user(); // ログインユーザー取得
        $pic = '';
        $disk = '';
        $filename = '';
        $fileUrl = '';

        // 名前とメールアドレスと自己紹介紹介だけ先にfill
        $user->fill($request->only(['name', 'email', 'introduction']));

        // 写真がアップロードされていれば
        if ($request->hasFile('pic')) {
            $pic = $request->file('pic'); // アップロードされたファイル
            // return $pic;
            $disk = Storage::disk('s3'); // ディスクを用意

            $filename = $disk->putFile('', $pic, 'public'); // 保存処理
            $fileUrl = $disk->url($filename); // urlを取得

            $user->pic = $fileUrl;
        }
        $user->save(); // 更新
        return response()->json(['user' => $user]);
    }
}
