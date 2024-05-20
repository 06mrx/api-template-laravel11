<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Parent\StudentPersonalDataController;
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

Route::post('auth/register', \App\Http\Controllers\API\Auth\RegisterController::class)->name('register');
Route::post('auth/login', \App\Http\Controllers\API\Auth\LoginController::class)->name('login');
Route::get('auth/login', \App\Http\Controllers\API\Auth\LoginController::class)->name('login');

Route::group(['namespace' => 'API', 'as' => 'api.'], function () {
    Route::group(['namespace' => 'parent', 'prefix' => 'parent', 'as' => 'parent.'], function () {
        Route::group(['namespace' => 'student-personal-data', 'prefix' => 'student-personal-data', 'as' => 'student-personal-data.'], function () {
            Route::get('show/{id_number}', [StudentPersonalDataController::class, 'show'])->name('show');
            Route::get('chart/{id_number}', [StudentPersonalDataController::class, 'chart'])->name('chart');
    
        });
    });
    // Register splitted api file
    Route::group([],__DIR__.'/api_reference.php');
});

