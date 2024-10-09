<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StudentCrudController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('email',[EmailController::class,'email']);

//Student Crud Routes
Route::get('/create',[StudentCrudController::class,'create']);
Route::post('/add-student',[StudentCrudController::class,'store'])->name('addStudent');
Route::get('view-students',[StudentCrudController::class,'viewStudents'])->name('viewStudents'); // i can return view in controller and fetch data and pass the data in the view
Route::view('view-student','studentCrud.list')->name('students');  //this is just for the view a table

Route::get('edit-student/{id}',[StudentCrudController::class,'editStudent'])->name('editStudent');

Route::post('update-student',[StudentCrudController::class,'update'])->name('updateStudent');

Route::get('delete-student/{id}',[StudentCrudController::class,'destroy'])->name('deleteStudent');

