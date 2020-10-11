<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailJapanese;
use App\Notifications\PasswordResetJapanese;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'pic', 'introduction', 'email', 'password', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 論理削除するプロパティ
     *
     * @var array
     */

    protected $dates = ['deleted_at'];


    //****************************************
    //      リレーション
    //****************************************


    /**
     * Stepモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function steps(): HasMany
    {
        return $this->hasMany('App\Step');
    }

    /**
     * Stageモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function stages(): HasMany
    {
        return $this->hasMany('App\Stage');
    }

    /**
     * Likeモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function likes(): HasMany
    {
        return $this->hasMany('App\Like');
    }

    /**
     * Relationモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function relations(): HasMany
    {
        return $this->hasMany('App\Relation');
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
     * Achievementモデルと1対多の関係
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function achievements(): HasMany
    {
        return $this->hasMany('App\Achievement');
    }

    /**
     * Clearモデルと1対多の関係
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function clears(): HasMany
    {
        return $this->hasMany('App\Clear');
    }


    /**
     * ユーザーがお気に入りにしたSTEP一覧を取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany ユーザーがお気に入りにしたステップを取得する
     */

    public function getLikeSteps(): BelongsToMany
    {
        return $this->belongsToMany('App\Step', 'likes', 'user_id', 'step_id');
    }

    /**
     * ユーザーのフォロー中一覧を取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany ユーザーのフォロー中ユーザー
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'relations', 'user_id', 'followed_id');
    }

    /**
     * ユーザーのフォロワー一覧を取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany ユーザーのフォロワー
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'relations', 'followed_id', 'user_id');
    }

    /**
     * ユーザーがクリアしたSTEP一覧を取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany ユーザーがクリアしたステップを取得
     */
    public function getClearSteps(): BelongsToMany
    {
        return $this->belongsToMany('App\Step', 'clears', 'user_id', 'step_id');
    }


    /**
     * ユーザーがチャレンジ中のSTEP一覧を取得する
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany ユーザーがチャレンジ中の投稿一覧
     */

    public function getChallengeSteps(): BelongsToMany
    {
        return $this->belongsToMany('App\Step', 'challenges', 'user_id', 'step_id');
    }


    //****************************************
    //      メソッド
    //****************************************


    /**
     * Eメール認証送信メソッドを日本語用にオーバーライド
     *
     * @access public
     * @param string $token セットしたトークン
     * @return void
     */

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailJapanese);
    }

    /**
     * パスワードリセット送信メソッドを日本語用にオーバーライド
     *
     * @access public
     * @param string $token セットしたトークン
     * @return void
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetJapanese($token));
    }

    /**
     * ユーザーのプロフィール写真を表示
     *  なければデフォルトのアイコンを表示
     *
     * @access public
     * @return string プロフィール写真のパスを、 登録されていなければデフォルトアイコン
     */
    public function getUserProfilePic(): string
    {

        // 既に登録されていればその画像を表示
        if (!empty($this->pic)) {
            return $this->pic;
        }

        return asset('images/NO_IMG.png');
    }
}
