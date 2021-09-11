<?php

namespace App\Models\Eleave;

use Illuminate\Database\Eloquent\Model;

class LeaveNumberic extends Model
{
    public function leavetakes() {
        return $this->belongsToMany('App\Models\Eleave\LeaveTake');
    }
    public function  bigtakes() {
        return $this->belongsTo('App\Models\Eleave\LeaveTake');
    }
}
