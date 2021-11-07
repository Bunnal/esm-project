<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserServiceGrade extends Model
{
    protected $fillable  =['service_grade'];
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
