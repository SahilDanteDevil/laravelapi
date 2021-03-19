<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;

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

Route::post('login',[AuthController::class,'login'])->name('login');
Route::post('register',[AuthController::class,'register'])->name('register');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' =>'auth:api'], function (){
	Route::get('user',[UserController::class,'user']);
	Route::put('user/info',[UserController::class,'updateInfo']);
	Route::put('user/password',[UserController::class,'updatePassword']);
	Route::post('upload',[ImageController::class,'upload']);
	Route::apiResource('/users',UserController::class);
	Route::apiResource('/roles',RoleController::class);
	Route::apiResource('/products',ProductController::class);
	Route::apiResource('/orders',OrderController::class)->only('index','show');
    Route::get('export',[OrderController::class,'export']);
});
