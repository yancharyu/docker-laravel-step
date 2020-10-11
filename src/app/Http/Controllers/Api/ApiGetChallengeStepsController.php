<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiGetChallengeStepsController extends Controller
{
    /**
     * チャレンジ中のステップを10件ずつ取得してJSON形式で返す
     *
     * @param  \Illuminate\Http\Request $request->fetchedIdList 既に取得済みのIDリスト
     * @return \Illuminate\Http\Response チャレンジ中のステップ
     */
    public function __invoke(Request $request): ?JsonResponse
    {
        $user = Auth::user();
        $fetched_step_id_list = $request->fetchedIdList; // 取得済みのIDリスト
        $offset = $fetched_step_id_list ? count($fetched_step_id_list) : 0;
        $limit = 10; // 一度に取得する件数
        $results_step_list = []; // 最終的に返却する配列
        $steps = $user->getChallengeSteps()->with(['user', 'category'])->withCount(['achievements' => function ($query) use ($user) {
            $query->where('achievements.user_id', $user->id);
        }, 'stages'])->offset($offset)->limit($limit)->latest()->get(); // withCountでステージの数とクリア数を数字で取得

        // 検索結果が空の場合は空の配列を返す
        if ($steps->isEmpty()) {
            return response()->json([]);
        }

        // 最初の取得などで 取得済みIDリストが空の場合は結果をそのまま返す
        if (is_null($fetched_step_id_list)) {
            return response()->json($steps);
        }

        // 取得した結果の中からIDリストに当てはまらないデータだけを配列に詰めて返す
        foreach ($steps as $step) {
            if (!in_array($step->id, $fetched_step_id_list)) {
                $results_step_list[] = $step;
            }
        }
        return response()->json($results_step_list);
    }
}
