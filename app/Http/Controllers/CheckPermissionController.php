<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
Use App\Models\User\UserMenu;
class CheckPermissionController extends Controller
{
    public function CheckPermission($module_id)
    {
        $count = DB::table('user_link_modules')
                ->where('user_id', auth()->user()->id)
                ->where('check', true)
                ->where('module_id', $module_id)
                ->count();
        if($count == 0)
            return abort(403, 'Unauthorized action.');
    }
    public function checkUserMenu($user_menus, $user_menus_uncheck,$id)
    {
        if(($user_menus && $user_menus_uncheck)!= null )
        {
            foreach($user_menus  as $value)
             {
                $create = UserMenu::where('user_id', $id)->where('menu_id',$value)->get();
                if(count($create)){
                    UserMenu::where('user_id', $id)->where('menu_id',$value)->where('enable',0)->update([
                      'enable' =>1,
                      
                    ]);
                }
                else{
                  UserMenu::create([
                      'menu_id' =>$value,
                      'user_id' =>$id,
                      'enable' =>1,
      
                  ]);
                }
             }
             foreach($user_menus_uncheck  as $value)
             {
                UserMenu::where('user_id', $id)->where('menu_id',$value)->update([
                     'enable' =>0,
                 ]);
             }
    
            }

            elseif($user_menus !=null && $user_menus_uncheck == null)
            {
                foreach($user_menus  as $value)
                {
                     $create = UserMenu::where('user_id', $id)->where('menu_id',$value)->get();
                      if(count($create)){
                        UserMenu::where('user_id', $id)->where('menu_id',$value)->where('enable',0)->update([
                            'enable' =>1,
                          ]);
                      }
                      else{
                        UserMenu::create([
                            'menu_id' =>$value,
                            'user_id' =>$id,
                            'enable' =>1,
                        ]);
                      }
                }
 
            }

            elseif($user_menus == null && $user_menus_uncheck != null)
            {
                foreach($user_menus_uncheck  as $value)
                {
                    UserMenu::where('user_id', $id)->where('menu_id',$value)->update([
                        'enable' =>0,
                    ]);
                }

            }
    }
}
