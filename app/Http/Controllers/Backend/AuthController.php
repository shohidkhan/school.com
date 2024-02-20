<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    //login page
    function loginPage(){

        if(!empty(Auth::check())){
            if(Auth::user()->user_type==1){
                return redirect("admin/dashboard");
            }elseif(Auth::user()->user_type==2){
                return redirect("teacher/dashboard");
            }elseif(Auth::user()->user_type==3){
                return redirect("student/dashboard");
            }elseif(Auth::user()->user_type==4){
                return redirect("parent/dashboard");
            }
        }
       
        return view("backend.auth.login");
    }


    //backend login process
    function login(Request $request){
        $request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]);
        $remember= !empty($request->remember) ? true : false;
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password],$remember)){
            if(Auth::user()->user_type==1){
                return redirect("admin/dashboard");
            }elseif(Auth::user()->user_type==2){
                return redirect("teacher/dashboard");
            }elseif(Auth::user()->user_type==3){
                return redirect("student/dashboard");
            }elseif(Auth::user()->user_type==4){
                return redirect("parent/dashboard");
            }
        }else{
            return redirect()->back()->with("error","Invalid Email or Password");
        }
    }

    //logout Process

    function logout(){
        Auth::logout();
        return redirect("/");
    }

    function forgetPassword(){
        return view("backend.auth.forget-password");
    }
    function PostForgetPassword(Request $request){
        // $user=User::getEmailCheck($request->email);
        $user=User::where("email","=",$request->email)->first();
        if(!empty($user)){
            $remember_token= Str::random(30);
            User::where("email","=",$request->email)->update(["remember_token"=>$remember_token]);
            $update_user=User::where("email","=",$request->email)->first();
            Mail::to($request->email)->send(new ForgetPasswordMail($update_user));
            return redirect()->back()->with("success","Please check your email and reset your password");
        }else{
            return redirect()->back()->with("error","Invalid Email");
        }
    }

    function resetPassword($token){
        $user=User::where("remember_token","=",$token)->first();
        if(!empty($user)){
            $data["user"]=$user;
            return view("backend.auth.reset-password",$data);
        }else{
            return abort(404);
        }
    }

    function PostResetPassword($token,Request $request){
        $user=User::where("remember_token","=",$token)->first();
        if(!empty($user)){
            if($request->password === $request->cpassword){
                $user->password=Hash::make($request->password);
                $user->remember_token= Str::random(30);
                $user->save();
                return redirect("/")->with("success","Password reset successfully");
            }else{
                return redirect()->back()->with("error","Password not match");
            }
        }else{
            return abort(404);
        }
    }
    // function register(){
    //     return view("backend.auth.register");
    // }
}
