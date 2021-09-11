<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user'; 
    
    public function users()
    {
        return $this->belongsToMany('App\Models\User\User');
    }
}
