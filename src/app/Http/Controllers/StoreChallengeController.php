<?php

namespace App\Http\Controllers;

use App\Step;
use App\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * チャレンジを登録してステップ１の画面に遷移させるコントローラー
 */

class StoreChallengeController extends Controller
{
    /**
     *
     * @param int $request->id ステップのID
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $step_id = $request->step_id; //ステップID
        $step = Step::with(['stages'])->findOrFail($step_id); // ステップと、紐づくステージ一覧を取得
        $step->challenges()->create(['user_id' => Auth::id()]); // チャレンジ登録

        $stages = $step->stages; // ステージ一覧を変数に格納
        $stage = $step->stages->first(); // ステージ一覧の最初の値を変数に格納
        $is_achievement = false;
        $is_before_stage_achievement = true;
        // ステージ詳細画面を表示
        return view('pages.stage', compact('stage', 'stages', 'is_achievement', 'is_before_stage_achievement'));
    }
}
