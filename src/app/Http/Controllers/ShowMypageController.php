<?php

namespace App\Http\Controllers;

use App\Step;
use App\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * マイページを表示するコントローラー
 */
class ShowMypageController extends Controller
{
    /**
     * マイページを表示
     *
     * @return \Illuminate\Http\Response
     */

    public function __invoke()
    {
        $user = Auth::user();
        $user->load(['followings', 'followers']);
        return view('pages.mypage', compact('user'));
    }
}
