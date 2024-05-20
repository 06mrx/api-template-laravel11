<?php

use App\Http\Controllers\API\Reference\WorkUnitController;
use App\Http\Controllers\API\Reference\EducationController;
use App\Http\Controllers\API\Reference\MaritalStatusController;
use App\Http\Controllers\API\Reference\PositionController;
use App\Http\Controllers\API\Reference\RankController;
use App\Http\Controllers\API\Reference\ReligionController;
use App\Http\Controllers\API\Reference\VillageController;
use App\Http\Controllers\API\Reference\DistrictController;
use App\Http\Controllers\API\Reference\StatusController;
use App\Http\Controllers\API\Reference\OutputUnitController;
use App\Http\Controllers\API\Reference\IncomeController;
use App\Http\Controllers\API\Reference\JobController;
use App\Http\Controllers\API\Reference\ParentTypeController;
use App\Http\Controllers\API\Reference\ResidenceTypeController;


Route::group(['namespace' => 'reference', 'prefix' => 'reference', 'as' => 'reference.'], function () {
    //contoh menggumakam midlleware
    Route::group(['namespace' => 'education', 'prefix' => 'education-with-middleware', 'as' => 'education.', 'middleware' => ['auth:sanctum, role:Administrator,Participant']], function () {
        Route::get('index', [EducationController::class, 'index'])->name('index');
    });
    Route::group(['namespace' => 'education', 'prefix' => 'education', 'as' => 'education.'], function () {
        Route::get('index', [EducationController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'marital-status', 'prefix' => 'marital-status', 'as' => 'marital-status.'], function () {
        Route::get('index', [MaritalStatusController::class, 'index'])->name('index');
    })->middleware('auth:sanctum');

    Route::group(['namespace' => 'position', 'prefix' => 'position', 'as' => 'position.'], function () {
        Route::get('index', [PositionController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'rank', 'prefix' => 'rank', 'as' => 'rank.'], function () {
        Route::get('index', [RankController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'religion', 'prefix' => 'religion', 'as' => 'religion.'], function () {
        Route::middleware('must-check')->get('index', [ReligionController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'village', 'prefix' => 'village', 'as' => 'village.'], function () {
        Route::get('index', [VillageController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'district', 'prefix' => 'district', 'as' => 'district.'], function () {
        Route::get('list', [DistrictController::class, 'list'])->name('list');
    });

    Route::group(['namespace' => 'village', 'prefix' => 'village', 'as' => 'village.'], function () {
        Route::get('search', [VillageController::class, 'search'])->name('search');
    });
    
    Route::group(['namespace' => 'work_unit', 'prefix' => 'work_unit', 'as' => 'work_unit.'], function () {
        Route::get('list', [WorkUnitController::class, 'list'])->name('list');
        Route::get('index', [WorkUnitController::class, 'index'])->name('index');
        Route::post('store', [WorkUnitController::class, 'store'])->name('store');
        Route::get('show/{id}', [WorkUnitController::class, 'show'])->name('show');
        Route::post('update/{id}', [WorkUnitController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [WorkUnitController::class, 'destroy'])->name('delete');
    });

    Route::group(['namespace' => 'status', 'prefix' => 'status', 'as' => 'status.'], function () {
        Route::get('index', [StatusController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'output-unit', 'prefix' => 'output-unit', 'as' => 'output-unit.'], function () {
        Route::get('index', [OutputUnitController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'income', 'prefix' => 'income', 'as' => 'income.'], function () {
        Route::get('index', [IncomeController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'job', 'prefix' => 'job', 'as' => 'job.'], function () {
        Route::get('index', [JobController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'parent-type', 'prefix' => 'parent-type', 'as' => 'parent-type.'], function () {
        Route::get('index', [ParentTypeController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'residence-type', 'prefix' => 'residence-type', 'as' => 'residence-type.'], function () {
        Route::get('index', [ResidenceTypeController::class, 'index'])->name('index');
    });
});