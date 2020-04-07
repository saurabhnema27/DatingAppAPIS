<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile_display extends Model
{
    public function slotting_done_on_profile()
    {
        return $this->hasMany('App\slotting_done_on_profile');
    }
}
