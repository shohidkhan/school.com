<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    //

    function batch_list(Request $request){
        //total batch
       
        $batches=Batch::with("user");
        if(!empty($request->name)){
            $batches=$batches->where("name","like","%".$request->name."%");
        }elseif(!empty($request->status)){

            $batches=$batches->where("status","=",$request->status);
        }
        $batches=$batches->paginate(10);
        $total_batch=Batch::count();
        return view('backend.pages.batch.batch_list',compact('total_batch',"batches"));
    }

    function batch_add(){
        try{
            return view("backend.pages.batch.add_batch");
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    function create_batch(Request $request){
    
            $request->validate([
                "name"=>"required",
                "status"=>"required",
            ]);

            Batch::create([
                "name"=>$request->name,
                "status"=>$request->status,
                "user_id"=>Auth::id(),
            ]);
            return redirect("/batch/list")->with("success","Batch created successfully");
        
    }

    function batch_status_change($id){
        try{
            $batch=Batch::findOrFail($id);
            
            Batch::where("id",$id)->update([
                "status"=>$batch->status === 1 ? 2 : 1,
            ]);
            return redirect("/batch/list")->with("success","Batch status changed successfully");
           
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
    function batch_edit($id){
        try{
            $batch=Batch::find($id);
            return view("backend.pages.batch.edit_batch",compact("batch"));
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    function update_batch(Request $request,$id){
        try{
            Batch::find($id)->update([
                "name"=>$request->name,
                "status"=>$request->status,
            ]);
            return redirect("/batch/list")->with("success","Batch updated successfully");
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
    function batch_delete($id){
        try{
            Batch::find($id)->delete();
            return redirect()->back()->with("success","Batch deleted successfully");
        }catch(Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
}
