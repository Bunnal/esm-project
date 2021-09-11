<?php

namespace App\Models\Eleave;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    public function leavetakes() {

        return $this->belongsToMany('App\Models\Eleave\LeaveTake');
    }
}
