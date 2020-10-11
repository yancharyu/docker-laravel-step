<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditPasswordRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EditPasswordController extends Controller
{
    /**
     * パスワード変更処理
     *
     * @param  App\Http\Requests\EditPasswordRequest $request パスワード変更フォームの情報
     * @return \Illuminate\Http\Response マイページへのルートを返す
     */
    public function __invoke(EditPasswordRequest $request): RedirectResponse
    {
        $user = Auth::user();
        // パスワード変更処理
        $user->fill(['password' => Hash::make($request->new_password)])->save();
        return redirect()->route('mypage')->with('success_message', __('パスワードを変更しました!'));
    }
}
