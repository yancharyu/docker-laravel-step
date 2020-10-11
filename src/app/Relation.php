<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'followed_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id',
        'followed_id'
    ];

    /**
     * IDの自動増加
     *
     * @var bool
     */

    public $incrementing = true;

    //****************************************
    //      リレーション
    //****************************************

    /**
     * Userモデルと多対1の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    //****************************************
    //      メソッド
    //****************************************

    /**
     * ログインユーザーが渡されたユーザーを既にフォローしているかどうかを判定
     *
     * @param int $id 検索するuser_id
     * @return boolean フォローしているかどうか
     */

    public static function getIsFollow($user_id): bool
    {
        // 制約に一致するレコードがあるか取得する
        $is_follow = Self::where('user_id', Auth::id())->where('followed_id', $user_id)->exists();
        return $is_follow;
    }


    /**
     * 自分のことをフォローしているかどうかを取得する
     *
     * @param int $user_id 検索するuser_id
     * @return boolean フォローしてるかどうか
     */
    public static function getIsFollowMe($user_id): bool
    {
        $is_followed = Self::where('user_id', $user_id)->where('followed_id', Auth::id())->exists();
        return $is_followed;
    }

    /**
     * フォローしていればフォローを削除する、フォローしていなければフォローする
     *
     * @param int $user_id フォロー操作をするユーザーのID
     * @return bool フォローしているかどうか
     */
    public static function toggleFollow($user_id): bool
    {
        $user = Auth::user(); // ログインユーザー

        // 既にフォローしているかを取得
        $is_follow = Self::getIsFollow($user_id);

        // 既にフォローしている場合はフォロー解除（削除）し、falseを返す
        if (!empty($is_follow)) {
            $user->relations()->where('followed_id', $user_id)->delete();
            return false;
        }

        // フォローしていない場合は新規登録
        $user->relations()->create(['followed_id' => $user_id]);
        return true;
    }
}
