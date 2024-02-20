<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    function changePassword(){
        return view("backend.pages.admin.change-password");
    }
    function postChangePassword(Request $request){
        // dd($request->all());
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'old_password' => 'required',
            'password_confirmation' => 'required|min:6'
        ]);

        $user_id=Auth::id();
        $user=User::findOrFail($user_id);

        if(Hash::check($request->old_password,$user->password)){
            User::where('id',$user_id)->update([
               "password"=>Hash::make($request->password), 
            ]);
            return redirect()->back()->with("success","Password changed successfully");
        }else{
            return redirect()->back()->with("error","Old password does not match");
        }
    }
}
