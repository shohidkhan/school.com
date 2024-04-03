<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    function changePassword(){
        return view("backend.pages.admin.change-password");
    }

    function myAccount(){
        try{
            $user=User::findOrFail(Auth::id());
            if($user->user_type==2){
                $teacher=Teacher::where("user_id",$user->id)->first();
                return view("backend.pages.teacher.my_account",compact("teacher"));
            }elseif ($user->user_type==3) {
                $student=Student::where("user_id",$user->id)->first();
                return view("backend.pages.student.my_account",compact("student"));
            }elseif($user->user_type==4){
                $parent=Parent::where("user_id",$user->id)->first();
                return view("backend.pages.parent.my_account",compact("parent"));
            }
            
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
    function myAccountEdit($id){
        try{

            $user=User::findOrFail(Auth::id());
            if($user->user_type==2){
                $teacher=Teacher::where("id",$id)->first();
                return view("backend.pages.teacher.my_account_edit",compact("teacher"));
            }elseif($user->user_type==3){
                $student=Student::where("id",$id)->first();
                $classes=Classes::get();
                $batches=Batch::get();
                return view("backend.pages.student.my_account_edit",compact("student","classes","batches"));
            }
            
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
    function postTeacherAccountUpdate(Request $request,$id){
        DB::beginTransaction();
        try{
            $teacher=Teacher::findOrFail($id);
            $user=User::where("id",$teacher->user_id)->first();
            $request->validate([
                'name'=>'required',
                'email'=>"required|unique:users,email,$user->id",
                'phone'=>'required|min:11',
                "date_of_birth"=>"required",
                "joining_date"=>"required",
                "religion"=>"required",
                "gender"=>"required",
                "blood_group"=>"required",
                "nationality"=>"required",
                "parmanent_address"=>"required",
                "present_address"=>"required",
                "marital_status"=>"required",
                "nid_no"=>"required|unique:teachers,nid_no,$teacher->id",
                "qualification"=>"required",
                "experience"=>"required",
                "designation"=>"required",
                "ssc_marks"=>"required",
                "ssc_board"=>"required",
                "hsc_marks"=>"required",
                "hsc_board"=>"required",
                "ssc_passing_year"=>"required",
                "hsc_passing_year"=>"required",
                "ssc_institute"=>"required",
                "hsc_institute"=>"required",
                "honours_marks"=>"required",
                "honours_institute"=>"required",
                "honours_passing_year"=>"required",
                "honours_subject"=>"required"
            ]);

            if($request->hasFile("profile_pic")){
                $teacher=Teacher::where("id",$id)->first();

                if($teacher->profile_pic != null){
                    unlink(public_path($teacher->profile_pic));
                }

                $new_image=$request->file("profile_pic");
                $new_image_name="profile_pic_".time().".".$new_image->getClientOriginalExtension();
                $new_image_path="uploads/profile/".$new_image_name;
                $new_image->move(public_path("uploads/profile"),$new_image_name);

                $teacher->update([
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "phone"=>$request->phone,
                    "date_of_birth"=>$request->date_of_birth,
                    "joining_date"=>$request->joining_date,
                    "religion"=>$request->religion,
                    "gender"=>$request->gender,
                    "blood_group"=>$request->blood_group,
                    "nationality"=>$request->nationality,
                    "parmanent_address"=>$request->parmanent_address,
                    "present_address"=>$request->present_address,
                    "marital_status"=>$request->marital_status,
                    "nid_no"=>$request->nid_no,
                    "qualification"=>$request->qualification,
                    "experience"=>$request->experience,
                    "designation"=>$request->designation,
                    "ssc_marks"=>$request->ssc_marks,
                    "ssc_board"=>$request->ssc_board,
                    "hsc_marks"=>$request->hsc_marks,
                    "hsc_board"=>$request->hsc_board,
                    "ssc_passing_year"=>$request->ssc_passing_year,
                    "hsc_passing_year"=>$request->hsc_passing_year,
                    "ssc_institute"=>$request->ssc_institute,
                    "hsc_institute"=>$request->hsc_institute,
                    "honours_marks"=>$request->honours_marks,
                    "honours_institute"=>$request->honours_institute,
                    "honours_passing_year"=>$request->honours_passing_year,
                    "honours_subject"=>$request->honours_subject,
                    "profile_pic"=>$new_image_path,
                    "masters_marks"=>$request->master_marks,
                    "masters_institute"=>$request->masters_institute,
                    "masters_passing_year"=>$request->masters_passing_year,
                    "masters_subject"=>$request->masters_subject,
                ]);

                $user->update([
                    "name"=>$request->name,
                    "email"=>$request->email,
                ]);
    
                DB::commit();
                return redirect()->back()->with(['success'=>'Teacher Updated successfully']);
            }else{
                $teacher=Teacher::where("id",$id)->first();
                $teacher->update([
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "phone"=>$request->phone,
                    "date_of_birth"=>$request->date_of_birth,
                    "joining_date"=>$request->joining_date,
                    "religion"=>$request->religion,
                    "gender"=>$request->gender,
                    "blood_group"=>$request->blood_group,
                    "nationality"=>$request->nationality,
                    "parmanent_address"=>$request->parmanent_address,
                    "present_address"=>$request->present_address,
                    "marital_status"=>$request->marital_status,
                    "nid_no"=>$request->nid_no,
                    "qualification"=>$request->qualification,
                    "experience"=>$request->experience,
                    "designation"=>$request->designation,
                    "ssc_marks"=>$request->ssc_marks,
                    "ssc_board"=>$request->ssc_board,
                    "hsc_marks"=>$request->hsc_marks,
                    "hsc_board"=>$request->hsc_board,
                    "ssc_passing_year"=>$request->ssc_passing_year,
                    "hsc_passing_year"=>$request->hsc_passing_year,
                    "ssc_institute"=>$request->ssc_institute,
                    "hsc_institute"=>$request->hsc_institute,
                    "honours_marks"=>$request->honours_marks,
                    "honours_institute"=>$request->honours_institute,
                    "honours_passing_year"=>$request->honours_passing_year,
                    "honours_subject"=>$request->honours_subject,
                    "profile_pic"=>$teacher->profile_pic,
                    "masters_marks"=>$request->master_marks,
                    "masters_institute"=>$request->masters_institute,
                    "masters_passing_year"=>$request->masters_passing_year,
                    "masters_subject"=>$request->masters_subject,
                ]);

                $user->update([
                    "name"=>$request->name,
                    "email"=>$request->email,
                ]);
    
                DB::commit();
                return redirect()->back()->with(['success'=>'Account Updated successfully']);
            }

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    function postStudentAccountUpdate(Request $request,$id){
        DB::beginTransaction();
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
            $user=User::where("id",$student->user_id)->first();
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
            $user->update([
                "name"=>$request->first_name." ".$request->last_name,
                "email"=>$request->email
            ]);
            DB::commit();
            return redirect()->back()->with("success","Student Update Successfully");
        }else{
            $student=Student::where("id",$id)->first();
            $user=User::where("id",$student->user_id)->first();
            $student->update([
                "class_id"=>$request->class_id,
                 "first_name"=>$request->first_name,
                 "last_name"=>$request->last_name,
                 "student_email"=>$request->email,
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
                 "father_phone"=>$request->father_phone,
                 "father_name"=>$request->father_name,
                 "mother_phone"=>$request->mother_phone,
                 "mother_name"=>$request->mother_name,
                 "guardian_name"=>$request->guardian_name,
                 "guardian_phone"=>$request->guardian_phone,
                 "emergency_contact"=>$request->emergency_contact,
                 "emergency_person_name"=>$request->emergency_person_name,
                 "emergency_person_relation"=>$request->emergency_person_relation,
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
            $user->update([
                "name"=>$request->first_name." ".$request->last_name,
                "email"=>$request->email
            ]);
            DB::commit();

            return redirect()->back()->with("success","Student Update Successfully");
        }
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error",$e->getMessage());
        }
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
