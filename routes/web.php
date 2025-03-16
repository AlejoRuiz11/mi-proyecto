<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
//use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-student', [StudentController::class, 'showForm']);
Route::post('/add-student', [StudentController::class, 'store']);

Route::get('/list-student', [StudentController::class, 'index']);