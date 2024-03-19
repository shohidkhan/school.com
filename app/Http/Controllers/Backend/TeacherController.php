<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //Teacher list page

    function teacher_list(Request $request){
            $teacher_lists=Teacher::with("user");
            if(!empty($request->name)){
                $teacher_lists=$teacher_lists->where("name","like","%".$request->name."%");
            }
            if(!empty($request->email)){
                $teacher_lists=$teacher_lists->where("email","like","%".$request->email."%");
            }
            if(!empty($request->phone)){
                $teacher_lists=$teacher_lists->where("phone","like","%".$request->phone."%");
            }
            if(!empty($request->nid_no)){
                $teacher_lists=$teacher_lists->where("nid_no","like","%".$request->nid_no."%");
            }
            if(!empty($request->status)){
                $teacher_lists=$teacher_lists->where("status",$request->status);
            }
            $teacher_lists=$teacher_lists->paginate(10);

            $total_teacher=Teacher::count();
            return view('backend.pages.admin.teacher.teacher_list',compact('teacher_lists',"total_teacher"));
    }
    function teacher_add(){
        return view('backend.pages.admin.teacher.teacher_add');
    }


    function create_teacher(Request$request){
        DB::beginTransaction();
        try{
            $request->validate([
                'name'=>'required',
                'email'=>'required|unique:users,email',
                'password'=>'required',
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
                "nid_no"=>"required|unique:teachers,nid_no",
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
                "honours_subject"=>"required",
                "status"=>"required",
                "user_type"=>"required",
            ]);


            $user=User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
                "user_type"=>$request->user_type
            ]);

            if($request->hasFile("profile_pic")){
                $image=$request->file("profile_pic");
                $image_name="profilr_pic_".time().".".$image->getClientOriginalName();
                $image_path="uploads/profile/".$image_name;
                $image->move(public_path("uploads/profile"),$image_name);
            }

            Teacher::create([
                "user_id"=>$user->id,
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
                "status"=> $request->status,
                "profile_pic"=>$request->hasFile("profile_pic")?$image_path:null,
                "masters_marks"=>$request->master_marks,
                "masters_institute"=>$request->masters_institute,
                "masters_passing_year"=>$request->masters_passing_year,
                "masters_subject"=>$request->masters_subject,
            ]);

            DB::commit();
            return redirect()->back()->with(['success'=>'Teacher created successfully']);
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    function teacher_details($id){
        try{
            $teacher=Teacher::findOrFail($id);
            return view('backend.pages.admin.teacher.teacher_details',compact('teacher'));
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    function teacher_status_change($id){
        try{
            $teacher=Teacher::findOrFail($id);
            if($teacher->status==1){
                $teacher->status=2;
            }else{
                $teacher->status=1;
            }
            $teacher->save();
            return redirect()->back()->with(['success'=>'Teacher status changed successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }


    function teacher_edit($id){
        try{
            $teacher=Teacher::findOrFail($id);
            return view('backend.pages.admin.teacher.teacher_edit',compact('teacher'));
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    function teacher_update(Request $request,$id){
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
                "honours_subject"=>"required",
                "status"=>"required",
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
                    "status"=> $request->status,
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
                    "status"=> $request->status,
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
                return redirect()->back()->with(['success'=>'Teacher Updated successfully']);
            }

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    function teacher_delete($id){
        DB::beginTransaction();
        try{
            $teacher=Teacher::findOrFail($id);
            $user=User::findOrFail($teacher->user_id);
            
            $teacher->delete();
            $user->delete();
            DB::commit();
            return redirect()->back()->with(['success'=>'Teacher deleted successfully']);
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }




}
