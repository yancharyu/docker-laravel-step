<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name'
    ];

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


    //****************************************
    //      メソッド
    //****************************************

    /**
     * カテゴリーを取得して返すメソッド
     *
     * @return Illuminate\Database\Eloquent\Collection カテゴリー全件
     */
    public static function getAllCategories(): Collection
    {
        return Self::all();
    }
}
