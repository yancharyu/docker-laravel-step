<?php

namespace App\Http\Controllers;

use App\Like;
use App\Step;
use App\Clear;
use App\Stage;
use App\Category;
use App\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditStepRequest;
use App\Http\Requests\StoreStepRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * stepのリソースコントローラークラス
 *
 * saveとcreateの使い分けは新規登録か更新かの明示的な使い分け
 *
 */


class StepController extends Controller
{

    /*＊
     * トップページを表示
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('pages.index');
    }

    /**
     * 新規step投稿ページを表示
     *
     * @return \Illuminate\Http\Response カテゴリー一覧を取得して作成フォームへ
     */

    public function create()
    {
        $categories = Category::getAllCategories();
        return view('pages.create', compact('categories'));
    }

    /**
     * 新規stepとstageを保存する
     *
     * ステージはステップに紐づく子ステップのこと。
     *
     * @param string $request->title 新規ステップのタイトル
     * @param integer $request->category 新規ステップのカテゴリID
     * @param string $request->description 新規ステップの説明
     * @param array $request->stage 新規ステップに紐づくステージ
     *              ステージの概要(summary)はnullを許容する
     * @return \Illuminate\Http\Response トップページへリダイレクト
     */

    public function store(StoreStepRequest $request): RedirectResponse
    {
        $user = Auth::user(); // ユーザーID
        $new_stages = [];  // リクエストのstage配列を多次元配列として格納する用の配列

        // 新規stepを登録し、登録したstepインスタンスを変数に格納(createメソッドの戻り値は作成したインスタンス)
        $new_step = $user->steps()->create([
            'category_id' => $request->input('category'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // リクエストのstage配列をforeachで$new_stages配列に格納（多次元配列）
        foreach ($request->stages as $val) {
            $new_stages[] = [
                'user_id' => $user->id,
                'title' => $val['title'],
                'summary' => $val['summary'],
                'time' => $val['time']
            ];
        }
        // stepに紐づくstageを保存
        $new_step->stages()->createMany($new_stages);

        return redirect()->route('step.index')->with('success_message', __('投稿しました！'));
    }

    /**
     * step詳細画面を表示
     *
     * @param  int $id 表示するstepのID
     * @return \Illuminate\Http\Response ステップ詳細画面にリダイレクト
     */

    public function show($id)
    {
        // ステップが見つからない場合はエラー
        $step = Step::with(['user', 'category', 'stages'])->findOrFail($id);
        $user_id = Auth::id();
        $likes_count = Like::getLikesCount($id); // いいねの数
        $is_liked = Like::getIsLiked($id); // 既にお気に入りいにしているか
        $is_challenge = Challenge::getIsChallenge($step->id); // チャレンジ中かどうか
        $is_cleared = Clear::getIsCleared($step->id); // クリアしているかどうか
        return view('pages.show', compact('step', 'user_id', 'is_liked', 'is_challenge', 'is_cleared', 'likes_count'));
    }

    /**
     * step編集画面を表示
     *
     * @param  int  $id 検索するstepのID
     * @return \Illuminate\Http\Response ステップ詳細画面にリダイレクト
     */

    public function edit($id)
    {
        $step = Step::with(['user', 'category'])->findOrFail($id);

        // STEPの投稿者以外がアクセスした場合はトップページに遷移させる
        if (!$step->canEdit($step->user_id)) {
            return redirect()->route('step.index');
        }
        $categories = Category::getAllCategories();
        return view('pages.edit_step', compact('step', 'categories'));
    }

    /**
     * stepの編集を保存します
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id stepのIDを受け取る
     * @return \Illuminate\Http\Response
     */

    public function update(EditStepRequest $request, $id): RedirectResponse
    {
        $user = Auth::user();

        // まずステージ以外の値（title, description, category）に変更があれば更新する
        $step = $user->steps()->with('stages')->findOrFail($id);

        // STEPの投稿者以外がアクセスした場合はトップページに遷移させる
        if (!$step->canEdit($step->user_id)) {
            return redirect()->route('step.index');
        }

        $step->fill($request->only(['title', 'category', 'description']))->save();

        // 次にstepに紐づくstageを更新
        foreach ($request->stages as $key => $stage) {
            $step->stages[$key]->fill($stage)->save();
        }

        return redirect()->route('step.index')->with('success_message', __('変更しました！'));
    }

    /**
     * stepを削除
     *
     * @param int $id 削除するstepのID
     * @return \Illuminate\Http\Response マイページにリダイレクト
     */
    public function destroy($id): RedirectResponse
    {
        $step = Step::findOrFail($id);
        // STEPの投稿者以外がアクセスした場合はトップページに遷移させる
        if (!$step->canEdit($step->user_id)) {
            return redirect()->route('step.index');
        }

        // 削除する
        $step->delete();
        return redirect()->route('mypage')->with('success_message', __('削除しました！'));
    }
}
