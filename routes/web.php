<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-student', [StudentController::class, 'showForm']);
Route::post('/add-student', [StudentController::class, 'store']);

Route::get('/list-student', [StudentController::class, 'index']);


Route::get('/productos', [ProductController::class, 'index']);

Route::get('/productos/crear', [ProductController::class, 'create'])->name('products.create');
Route::post('/productos', [ProductController::class, 'store'])->name('products.store');

Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

