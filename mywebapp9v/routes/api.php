<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Api\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function() {
    Route::resource('products', ProductController::class);
});

Route::post('register', [RegisterController::class,'register']);
Route::post('login', [RegisterController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::post('/item/update/{id}',[ItemController::class,"update"]);
    Route::post('/item/delete/{id}',[ItemController::class,"destroy"]);
    Route::get('/logout', [LogoutController::class,"logout"]);
    Route::get('/items',[ItemController::class, "index"]);
    Route::get('/item/detail/{id}',[ItemController::class,"show"]);
    Route::post('/item/add',[ItemController::class,"store"]);

});

