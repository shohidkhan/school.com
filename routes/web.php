<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BatchController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\ParentController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\SubjectController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\DashboardController;
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
    Route::get("/subject/status/change/{id}",[SubjectController::class,"subject_status_change"]);
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



    //batch backend routes
    Route::get("/batch/list",[BatchController::class,"batch_list"]);
    Route::get("/add/batch",[BatchController::class,"batch_add"]);
    Route::post("/create/batch",[BatchController::class,"create_batch"])->name("create.batch");
    Route::get("/batch/change/status/{id}",[BatchController::class,"batch_status_change"]);
    Route::get("/batch/edit/{id}",[BatchController::class,"batch_edit"]);
    Route::post("/update/batch/{id}",[BatchController::class,"update_batch"])->name("update.batch");
    Route::delete("/batch/delete/{id}",[BatchController::class,"batch_delete"])->name("batch.delete");

    // parents backend routes
    Route::get("/parent/list",[ParentController::class,"parent_list"]);
    Route::get("/add/parent",[ParentController::class,"parent_add"]);
    Route::post("/create/parent",[ParentController::class,"create_parent"])->name("create.parent");
    Route::get("/parent/status/change/{id}",[ParentController::class,"parent_status_change"]);
    Route::get("/parent/details/{id}",[ParentController::class,"parent_details"]);
    Route::get("/parent/edit/{id}",[ParentController::class,"parent_edit"]);
    Route::post("/parent/update/{id}",[ParentController::class,"parent_update"])->name("parent.update");
    Route::delete("/parent/delete/{id}",[ParentController::class,"parent_delete"])->name("parent.delete");
    Route::get("/assign/student/{id}",[ParentController::class,"assign_student"]);
    Route::post("/assign/student/store",[ParentController::class,"assign_student_store"])->name("assign.student.store");
    Route::delete("/assign/student/delete/{id}",[ParentController::class,"assign_student_delete"])->name("assign.student.delete");



    //Teacher backend routes
    Route::get("/teacher/list",[TeacherController::class,"teacher_list"]);
    Route::get("/add/teacher",[TeacherController::class,"teacher_add"]);
    Route::post("/create/teacher",[TeacherController::class,"create_teacher"])->name("create.teacher");
    Route::get("/teacher/details/{id}",[TeacherController::class,"teacher_details"]);
    Route::get("/teacher/status/change/{id}",[TeacherController::class,"teacher_status_change"]);
    Route::get("/teacher/edit/{id}",[TeacherController::class,"teacher_edit"]);
    Route::post("/teacher/update/{id}",[TeacherController::class,"teacher_update"])->name("teacher.update");
    Route::delete("/teacher/delete/{id}",[TeacherController::class,"teacher_delete"])->name("teacher.delete");
    
});


Route::group(["middleware"=>"teacher"],function(){
    Route::get("teacher/dashboard",[DashboardController::class,"home"]);
    Route::get("/teacher/account",[UserController::class,"myAccount"]);
    Route::get("/teacher/account/edit/{id}",[UserController::class,"myAccountEdit"]);
    Route::post("/teacher/account/update/{id}",[UserController::class,"postTeacherAccountUpdate"])->name("teacher.account.update");
    Route::get("/teacher/change-password",[UserController::class,"changePassword"]);
});


Route::group(["middleware"=>"student"],function(){
    Route::get("student/dashboard",[DashboardController::class,"home"]);
    Route::get("/student/account",[UserController::class,"myAccount"]);
    Route::get("/student/account/edit/{id}",[UserController::class,"myAccountEdit"]);
    Route::post("/student/account/update/{id}",[UserController::class,"postStudentAccountUpdate"])->name("student.account.update");
    Route::get("/student/change-password",[UserController::class,"changePassword"]);
});


Route::group(["middleware"=>"parent"],function(){
    Route::get("parent/dashboard",[DashboardController::class,"home"]);
    Route::get("/parent/account",[UserController::class,"myAccount"]);
    Route::get("/parent/account/edit/{id}",[UserController::class,"myAccountEdit"]);
    Route::post("/parent/account/update/{id}",[UserController::class,"postParentAccountUpdate"])->name("parent.account.update");
    Route::get("/parent/change-password",[UserController::class,"changePassword"]);
});

