<?php

namespace App\Http\Controllers\Api;

use App\Step;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


/**
 * Apiリクエストに対してステップを取得してJSON形式で返す
 * 検索条件があればその検索条件で検索した結果を返す
 */

class ApiGetStepController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request->keyword キーワード検索用のパラメータ
     * @param \Illuminate\Http\Request $request->category カテゴリ検索用のパラメータ
     * @param \Illuminate\Http\Request $request->fetchedIdList 既に取得済みのIDリスト
     * @return array ステップ一覧を15件ずつ取得して返す 結果がなければ空の配列
     */

    public function __invoke(Request $request): ?JsonResponse
    {
        $keyword = $request->keyword; // キーワード
        $category = $request->category; // カテゴリー
        $fetched_step_id_list = $request->fetchedIdList; // 取得済みのIDリスト
        $offset = $fetched_step_id_list ? count($fetched_step_id_list) : 0;
        $limit = 10; // 一度に取得する件数
        $results_step_list = []; // 最終的に返却する配列
        $user_id = Auth::id();

        $steps = Step::with(['user', 'category', 'challenges' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'clears' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])

            // キーワードがあればタイトルと説明文の中からキーワードに一致するものを取得する
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'LIKE', "%{$keyword}%")->orWhere('description', 'LIKE', "%{$keyword}%");
            })

            // カテゴリー検索の場合カテゴリーIDに一致するものを取得する
            ->when($category, function ($query, $category) {

                return $query->where('category_id', $category);
            })
            ->offset($offset)->limit($limit)->latest()->get();

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
