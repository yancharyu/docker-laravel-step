<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * 退会処理を行うコントローラー
 *
 */
class WithdrawController extends Controller
{
    /**
     * @return \Illuminate\Http\Response トップページにリダイレクト
     */
    public function __invoke(): RedirectResponse
    {
        $user = Auth::user();
        Auth::logout(); // ログアウト
        $user->steps()->delete(); // step削除
        $user->delete(); // ユーザー削除
        return redirect()->route('home');
    }
}
