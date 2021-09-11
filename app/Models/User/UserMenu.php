<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    protected $fillable =['user_id','menu_id','enable','view','create','edit','delete'];
    protected $table = 'user_link_menus';
    public function menu(){

        return $this ->belongsTo('App\Models\User\Menu','menu_id');
         
    }
    public function user()
    {
        return $this ->belongsto('App\Models\User\User','user_id');
    }
}
