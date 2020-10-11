<?php

namespace App\Http\Controllers\Api;

use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ステップに登録されているお気に入りの数と、
 *   ログインユーザーが既にお気に入りしているかどうかを取得して返す
 */

class ApiGetLikesCountController extends Controller
{
    /**
     * @param int $request->user_id ログインしているユーザーのID
     * @param int $request->step_id 検索するstepのID
     * @return \Illuminate\Http\Response お気に入りの総数と既にお気に入りにしているかどうか
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user_id = $request->user_id;
        $step_id = $request->step_id;

        // いいねの数
        $likes_count = Like::getLikesCount($step_id);
        // 既にお気に入りにしているかどうか
        $is_like = Like::getIsLiked($user_id, $step_id);

        // 結果を配列に格納してreturn
        $results = [
            'likesCount' => $likes_count,
            'isLiked' => $is_like
        ];

        return response()->json($results);
    }
}
