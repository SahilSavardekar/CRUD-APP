<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/product', [ProductController::class, 'index'])->name('products.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::delete('/product/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/trash', [ProductController::class, 'trashedRecords'])->name('products.trash');
    }
);

// Route::get('/product', [ProductController::class, 'index'])->name('products.index');

// Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/product', [ProductController::class, 'store'])->name('products.store');

// Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('products.update');

// Route::delete('/product/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');

Route::get('/active', [ProductController::class, 'activeRecords'])->name('products.active');

// Route::get('/trash', [ProductController::class, 'trashedRecords'])->name('products.trash');

Route::get('/trigger', [ProductController::class, 'triggerEvent'])->name('products.trigger');

Route::get('/getactive', [ProductController::class, 'getActive'])->name('products.Active');

Route::delete('/remove/{id}/force', [ProductController::class, 'forceDelete'])->name('products.remove');

Route::get('/signup', [UserController::class, 'signup'])->name('signup.get');

Route::get('/login', [UserController::class, 'login'])->name('login.get');

Route::post('/signup', [UserController::class, 'register'])->name('register');

Route::post('/login', [UserController::class, 'loginUser'])->name('user.login');

Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::delete('/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');

Route::delete('/product/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');

Route::delete('/user/{id}/delete', [UserController::class, 'remove'])->name('user.remove');
