<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * パスワード変更フォームを表示
 */
class ShowEditPasswordFormController extends Controller
{
    public function __invoke()
    {
        return view('pages.edit_password');
    }
}
