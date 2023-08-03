<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\TokenAuthentication;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::post('/urunekle', [ItemController::class, 'urunekle'])->name('urunekle');

              
    Route::get('/home', [ApiController::class, 'apigetir']);

    Route::get('/urunekle', [ApiController::class, 'uruneklecontrol'])->name('urunekle');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::post('/urunekle', [ItemController::class, 'ekle'])->name('ekle');

    Route::post('/urung/{id}', [ItemController::class, 'guncelle'])->name('guncelle');
    
    Route::delete('/urundel/{id}', [ItemController::class, 'sil'])->name('sil');

    


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

// Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Diğer sayfalar ve rotalar

