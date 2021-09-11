<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable =['name','link','module_id'];
    protected $table = 'user_menus';
    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }
}
