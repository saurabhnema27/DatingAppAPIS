<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'like_type', 'to_user_id','from_user_id',
    ];
}
