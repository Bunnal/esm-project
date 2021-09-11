<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    public function users()
    {
        return $this->hasMany('App\Models\User\User');
    }
}
