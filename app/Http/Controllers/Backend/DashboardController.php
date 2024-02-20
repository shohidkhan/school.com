<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    function home(){

        if(Auth::user()->user_type==1){
            return view("backend.pages.admin.dashboard");
        }elseif(Auth::user()->user_type==2){
            return view("backend.pages.teacher.dashboard");
        }elseif(Auth::user()->user_type==3){
            return view("backend.pages.student.dashboard");
        }elseif(Auth::user()->user_type==4){
            return view("backend.pages.parent.dashboard");
        }
        

    }
    

}
