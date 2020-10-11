<?php

namespace App\Http\Controllers\Api;

use App\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiGetIsFollowController extends Controller
{
    /**
     * リクエストで渡ってきたユーザーを既にフォローしているかを取得して返す
     *
     * @param  \Illuminate\Http\Request $request->user_id フォローしているか調べるユーザーのID
     * @return \Illuminate\Http\Response 既にフォローしているかどうか
     */
    public function __invoke(Request $request): JsonResponse
    {
        $is_follow = Relation::getIsFollow($request->user_id);
        return response()->json(['isFollow' => $is_follow]);
    }
}
