<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
//use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-student', function () {
    $student = new Student();
    $student->name = 'Juan Pérez';
    $student->age = 20;
    $student->email = 'juan@example.com';
    //$student->save();

    return "Estudiante agregado correctamente";
});

Route::get('/list-student', [StudentController::class, 'index']);