<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\User\Role;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email',
            'password' => 'required',
        ]);
        $getdata = [
            'email' =>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($getdata))
        {
            return redirect()->route('eleave')->with('login_msg','Welcome Back !');

        //   if(Auth::user()->hasAnyRole(['admin']))
        //   {
        //     return redirect()->route('home')->with('login_msg','Welcome Back !');

        //   }
        //   if(Auth::user()->hasAnyRole(['supervisor']))
        //   {
        //     return redirect()->route('supervisor.index')->with('login_msg','Welcome Back !');

        //   }else
        //   {
        //     return redirect()->route('myaccount')->with('login_msg','Welcome Back !');
        //   }
        }
        else 
        {
            return redirect()->back()->with('msg', 'Your Email or Password is incorrect!');
        }
 
    }
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login')->with('msg','You are logout !');
    }
}
