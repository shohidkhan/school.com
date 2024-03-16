<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\Command\EditCommand;

class StudentController extends Controller
{
    //

    function student_list()
    {
        $student_lists=Student::with("user","class")->paginate(10);
        return view('backend.pages.admin.student.student_list',compact('student_lists'));
    }

    function student_add(){
        $classes=Classes::get();
        $batches=Batch::get();
        return view('backend.pages.admin.student.student_add',compact('classes','batches'));
    }
    function student_view($id)
    {
        $student=Student::where("id",$id)->first();
        return view('backend.pages.admin.student.student_details',compact('student'));
    }

    function create_student(Request $request){
           DB::beginTransaction();
           
           try{
            
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
                'class_id'=>'required',
                "first_name"=>"required",
                "last_name"=>"required",
                 "admission_form_no"=>"required",
                 "gender"=>"required",
                 "date_of_birth"=>"required",
                 "religion"=>"required",
                 "parmanent_address"=>"required",
                 "present_address"=>"required",
                 "roll"=>"required",
                 "year"=>"required",
                 "registration_no"=>"required|unique:students,registration_no",
                 "nationality"=>"required",
                 "nid_no"=>"required",
                 "marital_status"=>"required",
                 "status"=>"required",
                 "admission_date"=>"required",
                 "father_phone"=>"required",
                 "father_name"=>"required",
                 "mother_phone"=>"required",
                 "mother_name"=>"required",
                 "guardian_name"=>"required",
                 "guardian_phone"=>"required",
                 "emergency_contact"=>"required",
                 "emergency_person_name"=>"required",
                 "emergency_person_relation"=>"required",
                 "user_type"=>"required",
                 "batch_id"=>"required"
            ]);
            
             
            if($request->hasFile("profile_pic")){
                $image=$request->file("profile_pic");
                $image_name="profile_pic_".md5(uniqid()).time().".".$image->getClientOriginalExtension();
                $image->move(public_path("uploads/profile"),$image_name);
                $image_path="uploads/profile/".$image_name;    
            };
             $user=User::create([
                 "name"=>$request->name,
                 "email"=>$request->email,
                 "password"=>Hash::make($request->password),
                 "user_type"=>$request->user_type
             ]);
 
             $user_id=$user->id;
             
             
             Student::create([
                 "user_id"=>$user_id,
                 "class_id"=>$request->class_id,
                 "first_name"=>$request->first_name,
                 "last_name"=>$request->last_name,
                 "admission_form_no"=>$request->admission_form_no,
                 "gender"=>$request->gender,
                 "date_of_birth"=>$request->date_of_birth,
                 "blood_group"=>$request->blood_group,
                 "parmanent_address"=>$request->parmanent_address,
                 "present_address"=>$request->present_address,
                 "roll"=>$request->roll,
                 "year"=>$request->year,
                 "registration_no"=>$request->registration_no,
                 "nationality"=>$request->nationality,
                 "nid_no"=>$request->nid_no,
                 "marital_status"=>$request->marital_status,
                 "religion"=>$request->religion,
                 "status"=>$request->status,
                 "father_phone"=>$request->father_phone,
                 "father_name"=>$request->father_name,
                 "mother_phone"=>$request->mother_phone,
                 "mother_name"=>$request->mother_name,
                 "guardian_name"=>$request->guardian_name,
                 "guardian_phone"=>$request->guardian_phone,
                 "emergency_contact"=>$request->emergency_contact,
                 "emergency_person_name"=>$request->emergency_person_name,
                 "emergency_person_relation"=>$request->emergency_person_relation,
                 "profile_pic"=> $request->hasFile("profile_pic") ? $image_path : "",
                 "student_email"=>$request->email,
                 "student_phone"=>$request->student_phone,
                 "birth_place"=>$request->birth_place,
                 "admission_date"=>$request->admission_date,
                 "weight"=>$request->weight,
                 "height"=>$request->height,
                 "father_occupation"=>$request->father_occupation,
                 "father_nid"=>$request->father_nid,
                 "mother_occupation"=>$request->mother_occupation,
                 "mother_nid"=>$request->mother_nid,
                 "guardian_occupation"=>$request->guardian_occupation,
                 "batch_id"=>$request->batch_id
             ]);
 
             DB::commit();
             return redirect()->back()->with("success","Student Created Successfully");
           }catch(Exception $e){
               DB::rollBack();
               return redirect()->back()->with("error",$e->getMessage());
           }
        
    }

    function student_status_change($id){

        $student=Student::where("id",$id)->first();
        if($student->status==1){
            $student->update([
                "status"=>0
            ]);
            return redirect()->back()->with("success","Student Inactive Successfully");
        }else{
            $student->update([
                "status"=>1
            ]);
            return redirect()->back()->with("success","Student Active Successfully");
        }
    }

    function student_edit($id){
        $student=Student::where("id",$id)->first();
        $classes=Classes::get();
        $batches=Batch::get();
        return view('backend.pages.admin.student.student_edit',compact('student','classes',"batches"));
    }

    public function student_update(Request $request, $id){
        $student=Student::where("id",$id)->first();
        $request->validate([
            'password'=>'required',
            'class_id'=>'required',
            "first_name"=>"required",
            "last_name"=>"required",
             "admission_form_no"=>"required",
             "gender"=>"required",
             "date_of_birth"=>"required",
             "religion"=>"required",
             "parmanent_address"=>"required",
             "present_address"=>"required",
             "roll"=>"required",
             "year"=>"required",
             "registration_no"=>"required|unique:students,registration_no".$student->id,
             "nationality"=>"required",
             "nid_no"=>"required",
             "marital_status"=>"required",
             "status"=>"required",
             "admission_date"=>"required",
             "father_phone"=>"required",
             "father_name"=>"required",
             "mother_phone"=>"required",
             "mother_name"=>"required",
             "guardian_name"=>"required",
             "guardian_phone"=>"required",
             "emergency_contact"=>"required",
             "emergency_person_name"=>"required",
             "emergency_person_relation"=>"required",
        ]);
    }

    


}
