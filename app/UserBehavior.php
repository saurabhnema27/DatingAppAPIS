<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBehavior extends Model
{
    //
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_like_type', 'total_dislike_type','total_superlike_type'
    ];
}
