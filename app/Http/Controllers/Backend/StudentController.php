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

    function student_list(Request $request)
    {
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
        return view('backend.pages.admin.student.student_list',compact('student_lists',"total_student","classes","batches","student_lists_count"));
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
                "status"=>2
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
        try{
        $student=Student::where("id",$id)->first();
        $request->validate([
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
             "registration_no"=>"required|unique:students,registration_no,$student->id",
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

        if($request->hasFile("profile_pic")){
            $student=Student::where("id",$id)->first();
            if($student->profile_pic != null){
                unlink(public_path($student->profile_pic));
            }
            $new_img=$request->file("profile_pic");
            $new_img_name="profile_pic".time().".".$new_img->getClientOriginalExtension();
            $new_img_path="uploads/profile/".$new_img_name;
            $new_img->move(public_path("uploads/profile"),$new_img_name);
            $student->update([
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
                 "profile_pic"=>  $new_img_path,
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

            return redirect()->back()->with("success","Student Update Successfully");
        }else{
            $student=Student::where("id",$id)->first();
            $student->update([
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
                 "profile_pic"=>  $student->profile_pic,
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

            return redirect()->back()->with("success","Student Update Successfully");
        }
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    


}
