<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    //subject list
    public function subject_list(Request $request)
    {   $subject_lists = Subject::with('class','user');
        if($request->subject_name){
            $subject_lists = $subject_lists->where("subject_name","like","%".$request->subject_name."%");
        }
        if($request->class_id){
            $subject_lists = $subject_lists->where("class_id","like","%".$request->class_id."%");
        }
        if($request->subject_code){
            $subject_lists = $subject_lists->where("subject_code","=",$request->subject_code);
        }
        if($request->subject_type){
            $subject_lists = $subject_lists->where("subject_type","=",$request->subject_type);
        }
        if($request->status){
            $subject_lists = $subject_lists->where("status","=",$request->status);
        }
        $subject_lists = $subject_lists->paginate(10);
        $classes=Classes::all();
        return view('backend.pages.subject.subject_list',compact('subject_lists','classes'));
    }

    function add_subject(){
        $classes=Classes::all();
        return view('backend.pages.subject.add_subject',compact('classes'));
    }

    function create_subject(Request $request){
        // dd($request->all());
        $request->validate([
            'subject_name' => 'required|string',
            'subject_code' => 'required|unique:subjects,subject_code',
            'subject_type' => 'required',
            'class_id' => 'required',
            'status' => 'required',
        ]);
       $user_id=Auth::id();

       Subject::create([
           'subject_name' => $request->subject_name,
           'subject_code' => $request->subject_code,
           'subject_type' => $request->subject_type,
           'class_id' => $request->class_id,
           'status' => $request->status,
           'user_id' => $user_id
       ]);
        return redirect()->back()->with('success', 'Subject created successfully.');
    }
    function subject_edit($id){
        $subject=Subject::find($id);
        $classes=Classes::all();
        return view('backend.pages.subject.edit_subject',compact('subject','classes'));
    }
    function update_subject(Request $request,$id){
        $request->validate([
            'subject_name' => 'required|string',
            'subject_code' => 'required',
            'subject_type' => 'required',
            'class_id' => 'required',
            'status' => 'required',
        ]);
        $subject=Subject::find($id);
        $subject->update([
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'subject_type' => $request->subject_type,
            'class_id' => $request->class_id,
            'status' => $request->status
        ]);
        return redirect("/subject/list")->with('success', 'Subject updated successfully.');
    }

    function subject_status_change(Request $request,$id){
        $subject=Subject::findOrFail($id);
        if($subject->status==1){
            Subject::where("id",$id)->update([
                "status"=> 2,
            ]);
            return redirect("/subject/list")->with('success', 'Subject status changed successfully.');
        }else{
            Subject::where("id",$id)->update([
                "status"=> 1,
            ]);
            return redirect("/subject/list")->with('success', 'Subject status changed successfully.');
        }
       
        
    }
    function delete_subject($id){
        $subject=Subject::find($id);
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully.');
    }
}
