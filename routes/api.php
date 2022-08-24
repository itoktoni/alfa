<?php

use App\Http\Controllers\APIController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Modules\Linen\Http\Controllers\KotorController;
use Modules\System\Http\Controllers\ActionController;

// use Helper;
// use Curl;
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
//

// Route::post('register_api', 'APIController@register');
// Route::post('login_api', [APIController::class, 'login']);
// Route::post('air_login', 'APIController@airLogin');

// Route::post('token', [ActionController::class, 'data'])->middleware('auth:sanctum');
Route::post('linen_sync', [KotorController::class, 'sync']);
