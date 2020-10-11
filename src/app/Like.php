<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'step_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'user_id' => 'integer',
        'step_id' => 'integer'
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

    /**
     * Stepモデルと多対1の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function step(): BelongsTo
    {
        return $this->belongsTo('App\Step');
    }


    //****************************************
    //      メソッド
    //****************************************

    /**
     * stepのIDからいいねの数を検索して返す関数
     *
     * @param int $step_id 検索するステップID
     * @return int そのstepのいいねの数
     */

    public static function getLikesCount($step_id): int
    {
        return Self::where('step_id', $step_id)->count();
    }

    /**
     * ログインユーザーがお気に入りしているかどうかを取得してBoolean値を返す
     *
     * @param int $id 検索するstepID
     * @return boolean お気に入りしていればtrue、していなければfalseを返す
     */

    public static function getIsLiked($step_id): bool
    {
        // 制約に一致するレコードがあるか取得する
        $is_like = Self::where('user_id', Auth::id())->where('step_id', $step_id)->exists();
        return $is_like;
    }
}
