<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'dob','gender','bio', 'age','user_id','is_user_active','latitude','longitude',
    ];

    

}
