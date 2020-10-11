<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'stage_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'user_id' => 'integer',
        'stage_id' => 'integer'
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

    public function stage(): BelongsTo
    {
        return $this->belongsTo('App\Stage');
    }


    //****************************************
    //      メソッド
    //****************************************

    /**
     * ユーザーがそのステージをクリア済みか取得する
     *
     * @param int $stage_id 検索するステージのID
     * @return boolean クリアしているかどうかの真偽値
     */

    public static function getIsAchievement($stage_id): bool
    {
        $is_achievement = Self::where('user_id', Auth::id())->where('stage_id', $stage_id)->exists();
        return $is_achievement;
    }
}
