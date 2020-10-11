<?php

namespace App\Http\Controllers\Api;

use App\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiToggleFollowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $opponent_user_id = $request->user_id;

        // フォロー処理を完了し、最終的にフォローしているかどうかを変数に格納
        $is_follow = Relation::toggleFollow($opponent_user_id);

        return response()->json(['isFollow' => $is_follow]);
    }
}
