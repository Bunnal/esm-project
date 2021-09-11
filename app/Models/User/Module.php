<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable =['module','link'];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
