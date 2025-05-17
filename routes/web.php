<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;



Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/list-student', [StudentController::class, 'index']);

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');;

Route::get('/productos/crear', [ProductController::class, 'create'])->name('products.create');
Route::post('/productos', [ProductController::class, 'store'])->name('products.store');

Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/productos/cancelar', function () {
    return redirect()->route('products.index');
})->name('products.cancelar');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Welcome Admin';
    });
});


require __DIR__.'/auth.php';