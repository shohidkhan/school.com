<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    //

    //class list view

    function class_list(Request $request){
        
        $class_lists=Classes::with("user");

        if(!empty($request->name)){
            $class_lists=$class_lists->where("name","like","%".$request->name."%");
        }
        if(!empty($request->status)){
           
            $class_lists=$class_lists->where("status","=",$request->status);

           
        }
        
        $class_lists = $class_lists->paginate(10);
        
        $total_class=Classes::count();
        return view("backend.pages.class.class_list",compact('class_lists',"total_class"));
    }

    //class add view
    function add_class(Request $request){
        return view("backend.pages.class.add_class");
    }

    //create class

    function create_class(Request $request){

        // dd($request->all());
        $user_id=Auth::id();
        $request->validate([
            "name"=>"required|unique:classes,name",
            "status"=>"required",
            
        ]);
        
        Classes::create([
            "name"=>$request->name,
            "status"=>$request->status,
            "user_id"=>$user_id,
        ]);
        return redirect()->back()->with("success","Class created successfully");
    }

    function class_edit($id){
        $class=Classes::findOrFail($id);
        return view("backend.pages.class.edit_class",compact("class"));
    }

    function update_class(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "status"=>"required",
        ]);

        $class=Classes::findOrFail($id);
        $class->update([
            "name"=>$request->name,
            "status"=>$request->status,
        ]);
        return redirect()->back()->with("success","Class updated successfully");

    }

    function changeStatus($id){
        $class=Classes::findOrFail($id);
        if($class->status==1){
            $class->update([
                "status"=>2
            ]);
        }else{
            $class->update([
                "status"=>1
            ]);
        }
        return redirect()->back();
    }

    function delete_class($id){
        $class=Classes::findOrFail($id);
        $class->delete();
        return redirect()->back()->with("success","Class deleted successfully");
    }
}
