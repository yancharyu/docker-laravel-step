<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiGetUserController extends Controller
{
    /**
     * ログイン中のユーザー情報を取得して返却
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = Auth::user();
        $user->load(['steps' => function ($query) {
            // 投稿日時を新しい順に取得
            $query->latest();
        }, 'steps.category', 'relations']);
        return response()->json(['user' => $user]);
    }
}
