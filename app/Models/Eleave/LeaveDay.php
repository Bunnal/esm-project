<?php

namespace App\Models\Eleave;

use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    public function leavetakes() {

        return $this->belongsToMany('App\Modesl\Eleave\LeaveTake');
    }
}
