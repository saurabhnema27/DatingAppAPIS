<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Otp;
use App\ReportUser;
use App\Like;


class User extends Authenticatable 
{
    use Notifiable,HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','number','is_user_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userdetail()
    {
        return $this->hasOne('App\Userdetail');
    }

    public function Otp()
    {
        return $this->hasMany('App\Otp');
    }

    public function reportuser()
    {
        return $this->hasMany('App\ReportUser');
    }

    public function Like()
    {
        return $this->hasMany('App\Like','from_user_id');
    }

    public function emailtoken()
    {
        return $this->hasMany('App\emailtoken');
    }

    public function Userintrest()
    {
        return $this->hasOne('App\Userintrest');
    }

    public function Userimage()
    {
        return $this->hasMany('App\Userimage');
    }
    
    public function BlockUser()
    {
        return $this->hasMany('App\BlockUser');
    }

    public function UserLocation()
    {
        return $this->hasOne('App\UserLocation');
    }

    public function UserRefer()
    {
        return $this->hasOne('App\UserRefer');
    }

    public function user_swiping_pattern()
    {
        return $this->hasMany('App\user_swiping_pattern');
    }
    
    public function UserPayment()
    {
        return $this->hasMany('App\UserPayment');
    }

    public function UserSlots()
    {
        return $this->hasMany('App/UserSlots');
    }
}
