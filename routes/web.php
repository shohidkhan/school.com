<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\SubjectController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class,"loginPage"]);
Route::post("/login",[AuthController::class,"login"]);
Route::get("/logout",[AuthController::class,"logout"]);
Route::get("/forget-password",[AuthController::class,"forgetPassword"]);
Route::post("/forget-password",[AuthController::class,"PostForgetPassword"]);
Route::get("/reset/{token}",[AuthController::class,"resetPassword"]);
Route::post("/reset-password/{token}",[AuthController::class,"PostResetPassword"]);
Route::get('/register',[AuthController::class,"register"]);

Route::post("/change-password",[UserController::class,"postChangePassword"]); 


Route::group(["middleware"=>"admin"],function(){
    Route::get("/admin/dashboard",[DashboardController::class,"home"]);
    //users route
    Route::get("/admin/list",[AdminController::class,"admin_list"]);
    Route::get("/admin/add",[AdminController::class,"admin_add"]);
    Route::post("/create/user",[AdminController::class,"create_user"])->name("create.user");
    Route::post("/update/user/{id}",[AdminController::class,"updateUser"])->name("update.user");
    Route::get("/user/edit/{id}",[AdminController::class,"user_edit"]);
    Route::delete("/user/delete/{id}",[AdminController::class,"user_delete"])->name("user.delete");

    //Class route
    Route::get("/class/list",[ClassController::class,"class_list"]);
    Route::get("/add/class",[ClassController::class,"add_class"]);
    Route::post("/create/class",[ClassController::class,"create_class"])->name("create.class");
    Route::get("/class/edit/{id}",[ClassController::class,"class_edit"]);
    Route::get("/changeStatus/{id}",[ClassController::class,"changeStatus"]);
    Route::post("/update/class/{id}",[ClassController::class,"update_class"])->name("update.class");
    Route::delete("/class/delete/{id}",[ClassController::class,"delete_class"])->name("class.delete");


    //subject route
    Route::get("/subject/list",[SubjectController::class,"subject_list"]);
    Route::get("/add/subject",[SubjectController::class,"add_subject"]);
    Route::post("/create/subject",[SubjectController::class,"create_subject"])->name("create.subject");
    Route::get("/subject/edit/{id}",[SubjectController::class,"subject_edit"]);
    Route::post("/update/subject/{id}",[SubjectController::class,"update_subject"])->name("update.subject");
    Route::delete("/subject/delete/{id}",[SubjectController::class,"delete_subject"])->name("subject.delete");


    //Password change Route
    Route::get("/admin/change-password",[UserController::class,"changePassword"]);


    //Student Routes

    Route::get("/student/list",[StudentController::class,"student_list"]);
    Route::get("/add/student",[StudentController::class,"student_add"]);
    Route::post("/create/student",[StudentController::class,"create_student"])->name("create.student");
    Route::get("/student/status/change/{id}",[StudentController::class,"student_status_change"]);
    Route::get("/student/view/{id}",[StudentController::class,"student_view"]);
    Route::get("/student/edit/{id}",[StudentController::class,"student_edit"]);
    Route::post("/student/update/{id}",[StudentController::class,"student_update"])->name("student.update");
    Route::get("/student/delete/{id}",[StudentController::class,"student_edit"])->name("student.delete");
    
});
Route::group(["middleware"=>"teacher"],function(){
    Route::get("teacher/dashboard",[DashboardController::class,"home"]);

    Route::get("/teacher/change-password",[UserController::class,"changePassword"]);
});
Route::group(["middleware"=>"student"],function(){
    Route::get("student/dashboard",[DashboardController::class,"home"]);

     Route::get("/student/change-password",[UserController::class,"changePassword"]);
});
Route::group(["middleware"=>"parent"],function(){
    Route::get("parent/dashboard",[DashboardController::class,"home"]);

     Route::get("/parent/change-password",[UserController::class,"changePassword"]);
});

