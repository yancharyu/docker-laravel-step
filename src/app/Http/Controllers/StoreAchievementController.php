<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\Step;
use App\Stage;
use App\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ステージ達成記録を登録し、次のステージ詳細画面に遷移させる
 * 全てのステージをクリアしている場合はマイページのクリアSTEP一覧画面に遷移する
 */

class StoreAchievementController extends Controller
{
    /**
     *
     * @param int $request->stage_id 検索用のステージID
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $stage_id = $request->stage_id;

        // 環境によって分岐する(cleardbは主キーの自動増分が10ずつ増えるから)
        // 開発環境
        if (config('app.env') === 'local') {
            $next_stage_id = $stage_id + 1; // 次に表示する用のステージID
            // 本番環境
        } elseif (config('app.env') === 'production') {
            $next_stage_id = $stage_id + 10;
        }

        $stage = Stage::findOrFail($stage_id); // STEP取得
        $stage->achievements()->create(['user_id' => Auth::id()]); // クリア記録を登録

        $step = Step::with(['stages'])->findOrFail($stage->step_id); // 取得したステージに所属するstepと紐づくステージ一覧を取得
        $stages = $step->stages; // 取得したステージ一覧を変数に格納

        // 次に検索するステージIDがステージ一覧の最後のIDより小さければ（まだステージを全て達成していない場合）次のステージを取得してステージ詳細画面を表示
        if ($next_stage_id <= $stages->last()->id) {
            $stage = Stage::find($next_stage_id); // ステージを取得
            $is_achievement = Achievement::getIsAchievement($next_stage_id);
            $is_before_stage_achievement = true;
            $request->session()->flash('success_message', __('次のステージが解禁されました'));
            return view('pages.stage', compact('stage', 'stages', 'is_achievement', 'is_before_stage_achievement'));
        }

        // 全てのステージをクリアした場合
        // クリア記録を登録
        $step->clears()->create(['user_id' => Auth::id()]);
        // チャレンジ中記録を削除
        $step->challenges()->where('user_id', Auth::id())->delete();
        // くりあSTEP一覧画面に遷移
        return redirect()->route('step.index')->with('all_clear', true);
    }
}
