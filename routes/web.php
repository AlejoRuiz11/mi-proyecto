<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CartController;


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

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
});

Route::get('/list-student', [StudentController::class, 'index']);

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');

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



Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{producto}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/eliminar/{producto}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/actualizar/{producto}', [CartController::class, 'update'])->name('cart.update');



require __DIR__.'/auth.php';