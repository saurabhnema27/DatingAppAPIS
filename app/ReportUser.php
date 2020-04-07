<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportUser extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id', 'to_user_id','from_user_id',
    ];
}
