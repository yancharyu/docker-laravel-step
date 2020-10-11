<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

trait InfiniteLoading
{
    /**
     *
     */
    public function infiniteLoading($request, $limit = 10): JsonResponse
    {
        $user = Auth::user();
        $fetched_id_list = $request->fetchedIdList; // 取得済みのIDリスト
        $offset = $fetched_id_list ? count($fetched_id_list) : 0;
        $limit = $limit; // 一度に取得する件数
        $results_step_list = []; // 最終的に返却する配列

        $results = (method_exists($this, 'sql')) ? $this->sql($user, $offset) : abort(404);

        // 検索結果が空の場合は空の配列を返す
        if ($results->isEmpty()) {
            return response()->json([]);
        }

        // 最初の取得などで 取得済みIDリストが空の場合は結果をそのまま返す
        if (is_null($fetched_id_list)) {
            return $results;
        }

        // 取得した結果の中からIDリストに当てはまらないデータだけを配列に詰めて返す
        foreach ($results as $follower) {
            if (!in_array($follower->id, $fetched_id_list)) {
                $results_step_list[] = $follower;
            }
        }
        return response()->json($results);
    }
}
