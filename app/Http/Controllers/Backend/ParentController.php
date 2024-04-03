<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\AssignStudentToParent;

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
            $assignedStudentToParents=AssignStudentToParent::where("parent_id",$id)->get();
            if(!count($assignedStudentToParents)>0){
               
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
            }else{
                return redirect()->back()->with("error","Parent is assigned to student");
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
            $assignStudent=AssignStudentToParent::where("parent_id",$id)->delete();
            $parent->delete();
            $user->delete();
            
            DB::commit();
            return redirect()->back()->with("success","Parent deleted successfully");
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    function assign_student(Request $request,$parent_id){
        $student_lists=Student::with("user","class");
        $student_lists_count=Student::with("user","class");
        if(!empty($request->name)){
            $student_lists=$student_lists->where("first_name","like","%".$request->name."%");
            $student_lists_count=$student_lists_count->where("first_name","like","%".$request->name."%");
        }
        if(!empty($request->roll)){
            $student_lists=$student_lists->where("roll","=",$request->roll);
            $student_lists_count=$student_lists_count->where("roll","=",$request->roll);
        }
        if(!empty($request->registration_no)){
            $student_lists=$student_lists->where("registration_no","=",$request->registration_no);
            $student_lists_count=$student_lists_count->where("registration_no","=",$request->registration_no);
        }
        if(!empty($request->class_id)){
            $student_lists=$student_lists->where("class_id","=",$request->class_id);
            $student_lists_count=$student_lists_count->where("class_id","=",$request->class_id);
        }
        if(!empty($request->batch_id)){
            $student_lists=$student_lists->where("batch_id","=",$request->batch_id);
            $student_lists_count=$student_lists_count->where("batch_id","=",$request->batch_id);
        }
        if(!empty($request->status)){
            $student_lists=$student_lists->where("status","=",$request->status);
            $student_lists_count=$student_lists_count->where("status","=",$request->status);
        }
        $total_student=Student::count();
        $classes=Classes::get();
        $batches=Batch::get();
        $student_lists_count=$student_lists_count->count();
        $student_lists=$student_lists->paginate(10);
        $assign_students=AssignStudentToParent::with("student","student.class")->where("parent_id",$parent_id)->orderBy("id","desc")->paginate(10);
        $total_assigned_student=AssignStudentToParent::where("parent_id",$parent_id)->count();
        return view("backend.pages.admin.parent.assign_student",compact('student_lists',"total_student","classes","batches","student_lists_count","parent_id","assign_students","total_assigned_student"));
    }

    function assign_student_store(Request $request){
        try{
            $request->validate([
                "student_id"=>"required|unique:assign_student_to_parents,student_id",
                "parent_id"=>"required",
            ]);
            $parent=Parents::where("id",$request->parent_id)->first();
            // dd($parent->status);
            if($parent->status==1){
                AssignStudentToParent::create([
                    "student_id"=>$request->student_id,
                    "parent_id"=>$request->parent_id
                ]);
                return redirect()->back()->with("success","Student assigned successfully");
            }else{
                return redirect()->back()->with("error","Parent is not active");
            }
            
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    function assign_student_delete($id){
        try{
            $assignStudent=AssignStudentToParent::where("id",$id)->first();
            $assignStudent->delete();
            return redirect()->back()->with("success","Student deleted successfully");

        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
}
