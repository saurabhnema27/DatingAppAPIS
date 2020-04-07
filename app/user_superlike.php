<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_superlike extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_expired',
    ];
}
