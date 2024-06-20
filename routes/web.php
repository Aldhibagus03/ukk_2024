<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\BarangkeluarController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware('auth')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/barangmasuk', BarangmasukController::class);
    Route::resource('/barangkeluar', BarangkeluarController::class);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});




