<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserPathController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/test",function(){
   return 0;
});

// Route::group(['middleware'=>"auth:sanctum"],function(){ 
Route::get('students',[StudentController::class,'list']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::post('add-student',[StudentController::class,'addStudent']);
Route::put('update-student/{id}',[StudentController::class,'updateStudent']);
Route::delete('delete-student/{id}',[StudentController::class,'deleteStudent']);
// });


// Route::post('log-in',[UserPathController::class,'login'])->name('login');

Route::resource('member',MemberController::class);

Route::post('signup',[UserPathController::class,'signup']);
Route::post('login',[UserPathController::class,'login']);