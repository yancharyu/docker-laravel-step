<?php

namespace App\Http\Controllers\Api;

use App\Like;
use App\Step;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * ログインユーザのお気に入りを登録する
 *    既にお気に入りにしていれば削除
 *
 */

class ApiToggleLikesController extends Controller
{
    /**
     *
     * @param int $request->user_id ログインユーザーのID
     * @param int $request->step_id 検索するstepのID
     * @return array 処理をした結果のboolean値といいねの総数を配列にまとめて返す
     */
    public function __invoke(Request $request)
    {
        $user_id = $request->user_id; // ユーザーID
        $step_id = $request->step_id; // stepID
        $step = Step::find($step_id); // step取得
        $likes_count = '';

        $sql = Like::where('user_id', $user_id)->where('step_id', $step_id);
        // まだお気に入りにしていなければ登録する
        if ($sql->doesntExist()) {
            $step->likes()->create(['user_id' => $user_id]);

            $likes_count = Like::getLikesCount($step_id); // いいね数取得

            return response()->json([
                'likesCount' => $likes_count,
                'isLiked' => true
            ]);
        }

        // 既にお気に入りに登録していれば削除する
        $sql->delete();
        $likes_count = Like::getLikesCount($step_id); // いいね数

        return response()->json([
            'likesCount' => $likes_count,
            'isLiked' => false
        ]);
    }
}
