<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //user lists

    function admin_list(Request $request){
        $user_lists=User::where("id","!=",Auth::id());
                if(!empty($request->name) ){
                   $user_lists=$user_lists->where("name","like","%".$request->name."%");
                   
                }
                if(!empty($request->email) ){
                    $user_lists=$user_lists->where("email","like","%".$request->email."%");
                }
        $user_lists=$user_lists->paginate(10);        
        $total_users=User::count();
        return view("backend.pages.admin.admin_list",compact("user_lists","total_users"));
    }
    // Add admin page
    function admin_add(){  
        return view("backend.pages.admin.add_admin",);
    }
    // Create admin
    function create_user(Request $request){
        // dd($request->all());
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:6",
            "user_type"=>"required",
        ]);

        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "user_type"=>$request->user_type
        ]);
        
        return redirect()->back()->with("success","User created successfully");
    }


    function user_edit($id){
        $user=User::findOrFail($id);
        return view("backend.pages.admin.user_edit",compact("user"));
    }

    function updateUser(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "user_type"=>"required",
            "password"=>"required|min:6",
        ]);
        $user=User::findOrFail($id);
        $user->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "user_type"=>$request->user_type,
            "password"=>Hash::make($request->password),
        ]);
        return redirect("/admin/list")->with("success","User updated successfully");
    }

    function user_delete($id){
        
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with("success","User deleted successfully");
    }

}
