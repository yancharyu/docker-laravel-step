<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * ホームページを表示する
 */

class ShowHomeController extends Controller
{
    // 既にログイン中ならトップページに飛ばす
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke()
    {
        return view('pages.home');
    }
}
