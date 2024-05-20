<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/token-check', function () {
    $response = [
        'success' => true,
        'message' => 'authorized',
    ];
    return response()->json($response);
});

Route::middleware('must-check')->post('auth/register', \App\Http\Controllers\API\Auth\RegisterController::class)->name('register');
Route::middleware('must-check')->post('auth/login', \App\Http\Controllers\API\Auth\LoginController::class)->name('login');
Route::middleware('must-check')->get('auth/login', \App\Http\Controllers\API\Auth\LoginController::class)->name('login');

Route::group(['namespace' => 'API', 'as' => 'api.'], function () {

    // Register splitted api file
    Route::group([],__DIR__.'/api_reference.php');
});

