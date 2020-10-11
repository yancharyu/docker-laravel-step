<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * 退会フォームを表示
 */

class ShowWithdrawFormController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */

    public function __invoke()
    {
        $user = Auth::user();
        return view('pages.withdraw', compact('user'));
    }
}
