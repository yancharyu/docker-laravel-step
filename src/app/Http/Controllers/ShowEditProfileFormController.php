<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ユーザー情報を取得して、プロフィール編集ページを表示
 */
class ShowEditProfileFormController extends Controller
{
    /**

     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = Auth::user();
        return view('pages.edit_profile', compact('user'));
    }
}
