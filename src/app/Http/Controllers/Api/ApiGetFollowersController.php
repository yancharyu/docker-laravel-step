<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApiGetFollowersController extends Controller
{
    /**
     * ユーザーのフォロワー一覧を10件ずつ取得して返す
     *
     * @param  \Illuminate\Http\Request $request->fetchedIdList 既に取得済みのIDリスト
     * @return \Illuminate\Http\Response フォロワー一覧
     */
    public function __invoke(Request $request): ?JsonResponse
    {
        $fetched_id_list = $request->fetchedIdList; // 取得済みのIDリスト
        $offset = $fetched_id_list ? count($fetched_id_list) : 0;
        $limit = 10; // 一度に取得する件数
        $results_step_list = []; // 最終的に返却する配列
        $followers = Auth::user()->followers()->offset($offset)->limit($limit)->latest()->get();

        // 検索結果が空の場合は空の配列を返す
        if ($followers->isEmpty()) {
            return response()->json([]);
        }

        // 最初の取得などで 取得済みIDリストが空の場合は結果をそのまま返す
        if (is_null($fetched_id_list)) {
            return response()->json($followers);
        }

        // 取得した結果の中からIDリストに当てはまらないデータだけを配列に詰めて返す
        foreach ($followers as $follower) {
            if (!in_array($follower->id, $fetched_id_list)) {
                $results_step_list[] = $follower;
            }
        }
        return response()->json($followers);
    }
}
