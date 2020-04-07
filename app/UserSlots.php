<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSlots extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_seen_by_user','slot_id','is_slot_shown'
    ];

}
