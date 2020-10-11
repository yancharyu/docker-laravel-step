<?php

namespace App\Http\Controllers;

use App\Step;
use App\User;
use App\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * 投稿者のプロフィール情報を取得してプロフィールページに遷移
     *
     * @param int $request->step_id プロフィール情報を検索するSTEPのID
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // ユーザーID
        $user_id = $request->id;
        $my_user_id = Auth::id();

        // 現在ログインしているユーザーIDと一致すればマイページに遷移する
        if ($user_id == $my_user_id) {
            return redirect()->route('mypage');
        }

        // ユーザー情報取得
        $user = User::findOrFail($user_id);
        // ステップ一覧を取得
        $steps = Step::with(['user', 'category', 'challenges' => function ($query) use ($my_user_id) {
            // ログインユーザーがチャレンジ中かクリア済みかどうかも取得する
            $query->where('user_id', $my_user_id);
        }, 'clears' => function ($query) use ($my_user_id) {
            $query->where('user_id', $my_user_id);
        }])->where('user_id', $user->id)->latest()->get();

        // このユーザーからフォローされているかどうか
        $is_followed = Relation::getIsFollowMe($user_id);

        return view('pages.profile', compact('user', 'steps', 'is_followed'));
    }
}
