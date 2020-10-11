<?php

namespace App\Http\Controllers;

use App\Clear;
use App\Stage;
use App\Challenge;
use App\Achievement;
use Illuminate\Http\Request;

/**
 * ステージ詳細を表示するコントローラー
 */
class ShowStageController extends Controller
{
    /**
     *
     * 渡されたIDから取得してステージと、ステップに紐づくステージを
     *     全て取得してstage詳細ページを表示する
     *
     * @param int $request->stage_id 検索するステージのID
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $stage_id = $request->stage_id;
        $stage = Stage::findOrFail($stage_id); // 選択されたステージを取得
        // ユーザーがチャレンジ中かクリア済みでなければエラーを投げる。
        if (!Challenge::getIsChallenge($stage->step_id) && !Clear::getIsCleared($stage->step_id)) {
            abort(404);
        }


        $stages = Stage::where('step_id', $stage->step_id)->get(); // stepに紐づくstage一覧
        $first_stage_id = $stages->first()->id;
        // ステージが１の場合は無条件に表示する
        if ($stage_id == $first_stage_id) {
            $is_achievement = Achievement::getIsAchievement($stage_id);
            $is_before_stage_achievement = true;
        } else {
            // 1以上の場合はひとつ前のステージをクリアしているかを検索して、その真偽値を返す
            $is_achievement = Achievement::getIsAchievement($stage_id);

            // herokuのcleardbはデータベースの主キーを10ずつincrementするので環境によって探すstage_idを変更する
            // =========== 開発環境の場合 ================
            if (config('app.env') === 'local') {
                $is_before_stage_achievement = Achievement::getIsAchievement($stage_id - 1);
                // 本番環境の場合
            } elseif (config('app.env') === 'production') {
                $is_before_stage_achievement = Achievement::getIsAchievement($stage_id - 10);
            }
        }
        return view('pages.stage', compact('stage', 'stages', 'is_achievement', 'is_before_stage_achievement'));
    }
}
