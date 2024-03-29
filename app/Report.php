<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_title', 'report_content',
    ];
}
