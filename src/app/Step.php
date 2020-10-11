<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Step extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'category_id', 'title', 'description',
    ];

    /**
     * 論理削除するプロパティ
     *
     * @var array
     */

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'user_id' => 'integer',
        'category_id' => 'integer',
    ];

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
     * Categoryモデルと1対多の関係
     *
     * @access public
     * Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Stageモデルと多対1の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function stages(): HasMany
    {
        return $this->hasMany('App\Stage');
    }

    /**
     * ステップに紐づく達成されたステージを取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasManyThrough
     */

    public function achievements(): HasManyThrough
    {
        return $this->hasManyThrough('App\Achievement', 'App\Stage', 'step_id', 'stage_id', 'id', 'id');
    }

    /**
     * Likeモデルと多対1の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function likes(): HasMany
    {
        return $this->hasMany('App\Like');
    }

    /**
     * Challengeモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function challenges(): HasMany
    {
        return $this->hasMany('App\Challenge');
    }

    /**
     * Clearモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function clears(): HasMany
    {
        return $this->hasMany('App\Clear');
    }

    /**
     * このSTEPにお気に入りしているユーザーを取得
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany ステップにお気に入りをしているユーザー
     */

    public function getLikeUser(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes', 'step_id', 'user_id');
    }

    /**
     * このSTEPをクリア済みのユーザーを取得
     *
     * @access public
     * @return array このSTEPにお気に入りしているユーザー一覧
     */

    public function getClearUsers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'clears', 'step_id', 'user_id');
    }



    /**
     * このSTEPにチャレンジ中のユーザ一覧を取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany チャレンジ中のユーザー一覧
     */

    public function getChallengeUsers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'challenges', 'user_id', 'step_id');
    }

    /**
     * ログインユーザーがそのSTEPを編集できるか
     *
     * @param int $user_id stepのuser_id
     * @return boolean 編集できるかどうか
     */

    public function canEdit($user_id): bool
    {
        if (Auth::check() && Auth::id() === $user_id) {
            return true;
        }

        return false;
    }
}
