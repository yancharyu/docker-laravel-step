<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'step_id', 'title', 'summary', 'time'
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
}
