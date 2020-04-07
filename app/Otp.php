<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'otp', 'user_id', 'is_otp_used','otp_is_for',
    ];
}
