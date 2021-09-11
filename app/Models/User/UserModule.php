<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    public $timestamps = false;
    protected $fillable =['user_id','module_id','check','name'];
    protected $table = 'user_link_modules';

    public function module(){

        return $this ->belongsTo('App\Models\User\Module','module_id');
         
    }
    public function user()
    {
        return $this ->belongsto('App\Models\User\User','user_id');
    }
    // public function Module()
    // {
    //     return $this ->belongsto('App\User');
    // }
   
}

