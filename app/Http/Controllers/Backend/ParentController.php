<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    //

    function parent_list(Request $request){
        $parents = Parents::with("user");
        if(!empty($request->name)){
            $parents=$parents->where("name","like","%".$request->name."%");
        }
        if(!empty($request->email)){
            $parents=$parents->where("email","like","%".$request->email."%");
        }
        if(!empty($request->phone)){
            $parents=$parents->where("phone","like","%".$request->phone."%");
        }
        if(!empty($request->nid_no)){
            $parents=$parents->where("nid_no","like","%".$request->nid_no."%");
        }
        if(!empty($request->status)){
            $parents=$parents->where("status",$request->status);
        }
        $total_parents=Parents::count();
        $parents=$parents->paginate(10);
        return view('backend.pages.admin.parent.parent_list',compact("parents","total_parents"));
    }
    function parent_add(){
        return view("backend.pages.admin.parent.add_parent");
    }
    function create_parent(Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                "name"=>"required",
                "email"=>"required|email|unique:users",
                "password"=>"required",
                "phone"=>"required|min:11|max:14",
                "address"=>"required",
                "nid_no"=>"required|unique:parents,nid_no",
                "gender"=>"required",
                "occupation"=>"required",
                "status"=>"required",
                "user_type"=>"required",
            ]);

            $user=User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
                "user_type"=>$request->user_type,
            ]);

            Parents::create([
                "user_id"=>$user->id,
                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "address"=>$request->address,
                "nid_no"=>$request->nid_no,
                "gender"=>$request->gender,
                "occupation"=>$request->occupation,
                "status"=>$request->status
            ]);

            DB::commit();

            return redirect()->back()->with("success","Parent created successfully");
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    function parent_status_change($id){
        try{
            $parent=Parents::findOrFail($id);
            if($parent->status==1){
                Parents::where("id",$id)->update([
                    "status"=>2,
                ]);
                return redirect()->back()->with('success', 'Parent status changed successfully.');
            }else{
                Parents::where("id",$id)->update([
                    "status"=>1,
                ]);
                return redirect()->back()->with('success', 'Parent status changed successfully.');
            }
       
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
        
    }

    function parent_details($id){
        $parent=Parents::findOrFail($id);
        return view("backend.pages.admin.parent.parent_details",compact("parent"));
    }

    function parent_edit($id){
        $parent=Parents::findOrFail($id);
        return view("backend.pages.admin.parent.edit_parent",compact("parent"));
    }
    function parent_update(Request $request,$id){
        DB::beginTransaction();
        try{
            $parent=Parents::findOrFail($id);
            $user=User::findOrFail($parent->user_id);
            $request->validate([
                "name"=>"required",
                "email"=>"required",
                "phone"=>"required|min:11|max:14",
                "address"=>"required",
                "nid_no"=>"required|unique:parents,nid_no,$parent->id",
                "gender"=>"required",
                "occupation"=>"required",
                "status"=>"required",
            ]);
            $parent->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "address"=>$request->address,
                "nid_no"=>$request->nid_no,
                "gender"=>$request->gender,
                "occupation"=>$request->occupation,
                "status"=>$request->status
            ]);
            $user->update([
               "email"=>$request->email, 
            ]);
            DB::commit();

            return redirect()->back()->with("success","Parent updated successfully");

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
    function parent_delete($id){
        DB::beginTransaction();
        try{
            $parent=Parents::where("id",$id)->first();
            $user=User::where("id",$parent->user_id)->first();
        
            $parent->delete();
            $user->delete();
            
            DB::commit();
            return redirect()->back()->with("success","Parent deleted successfully");
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
}
