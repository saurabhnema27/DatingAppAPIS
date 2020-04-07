<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slotting_done_on_profile extends Model
{
    //
    public function interval_to_allocate()
    {
        return $this->hasOne('App\interval_to_allocate');
    }
}
