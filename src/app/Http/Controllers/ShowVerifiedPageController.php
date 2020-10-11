<?php

namespace App\Http\Controllers;

/**
 * メール認証が成功したことを通知するページへ遷移
 */
class ShowVerifiedPageController extends Controller
{
    public function __invoke()
    {
        return view('auth.verified');
    }
}
