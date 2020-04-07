<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iwilliwillnot extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_will', 'i_will_not','user_id',
    ];

}
