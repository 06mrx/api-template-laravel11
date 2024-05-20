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
use App\Http\Controllers\API\Reference\TransportationTypeController;
use App\Http\Controllers\API\Reference\ReasonReceiveIndonesiaSmartProgramController;
use App\Http\Controllers\API\Reference\StudentLiterationDevelopmentIndicator;
use App\Http\Controllers\API\Reference\StudentLiterationDevelopmentScope;
use App\Http\Controllers\API\Reference\StudentNumerationDevelopmentIndicator;
use App\Http\Controllers\API\Reference\StudentNumerationDevelopmentScope;
use App\Http\Controllers\API\Reference\ReferenceStudentDevelopmentScoringController;
use App\Http\Middleware\EnsureUserHasRole;

Route::group(['namespace' => 'reference', 'prefix' => 'reference', 'as' => 'reference.'], function () {
    Route::group(['namespace' => 'education', 'prefix' => 'education', 'as' => 'education.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [EducationController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'marital-status', 'prefix' => 'marital-status', 'as' => 'marital-status.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [MaritalStatusController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'position', 'prefix' => 'position', 'as' => 'position.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [PositionController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'rank', 'prefix' => 'rank', 'as' => 'rank.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [RankController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'religion', 'prefix' => 'religion', 'as' => 'religion.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [ReligionController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'village', 'prefix' => 'village', 'as' => 'village.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [VillageController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'district', 'prefix' => 'district', 'as' => 'district.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('list', [DistrictController::class, 'list'])->name('list');
    });

    Route::group(['namespace' => 'village', 'prefix' => 'village', 'as' => 'village.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('search', [VillageController::class, 'search'])->name('search');
    });
    
    Route::group(['namespace' => 'work_unit', 'prefix' => 'work_unit', 'as' => 'work_unit.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('list', [WorkUnitController::class, 'list'])->name('list');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [WorkUnitController::class, 'index'])->name('index');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('store', [WorkUnitController::class, 'store'])->name('store');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('show/{id}', [WorkUnitController::class, 'show'])->name('show');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('update/{id}', [WorkUnitController::class, 'update'])->name('update');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->delete('delete/{id}', [WorkUnitController::class, 'destroy'])->name('delete');
    });

    Route::group(['namespace' => 'status', 'prefix' => 'status', 'as' => 'status.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [StatusController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'output-unit', 'prefix' => 'output-unit', 'as' => 'output-unit.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [OutputUnitController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'income', 'prefix' => 'income', 'as' => 'income.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [IncomeController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'job', 'prefix' => 'job', 'as' => 'job.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [JobController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'parent-type', 'prefix' => 'parent-type', 'as' => 'parent-type.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [ParentTypeController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'residence-type', 'prefix' => 'residence-type', 'as' => 'residence-type.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [ResidenceTypeController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'transportation-type', 'prefix' => 'transportation-type', 'as' => 'transportation-type.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [TransportationTypeController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'reason-receive-indonesia-smart-program', 'prefix' => 'reason-receive-indonesia-smart-program', 'as' => 'reason-receive-indonesia-smart-program.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [ReasonReceiveIndonesiaSmartProgramController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'student-literation-development-indicator', 'prefix' => 'student-literation-development-indicator', 'as' => 'student-literation-development-indicator.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [StudentLiterationDevelopmentIndicator::class, 'index'])->name('index');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('store', [StudentLiterationDevelopmentIndicator::class, 'store'])->name('store');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('update/{id}', [StudentLiterationDevelopmentIndicator::class, 'update'])->name('update');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->delete('destroy/{id}', [StudentLiterationDevelopmentIndicator::class, 'destroy'])->name('destroy');
    });

    Route::group(['namespace' => 'student-numeration-development-indicator', 'prefix' => 'student-numeration-development-indicator', 'as' => 'student-numeration-development-indicator.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [StudentNumerationDevelopmentIndicator::class, 'index'])->name('index');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('store', [StudentNumerationDevelopmentIndicator::class, 'store'])->name('store');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('update/{id}', [StudentNumerationDevelopmentIndicator::class, 'update'])->name('update');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->delete('destroy/{id}', [StudentNumerationDevelopmentIndicator::class, 'destroy'])->name('destroy');
    });

    Route::group(['namespace' => 'student-literation-development-scope', 'prefix' => 'student-literation-development-scope', 'as' => 'student-literation-development-scope.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [StudentLiterationDevelopmentScope::class, 'index'])->name('index');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('store', [StudentLiterationDevelopmentScope::class, 'store'])->name('store');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('update/{id}', [StudentLiterationDevelopmentScope::class, 'update'])->name('update');
    });

    Route::group(['namespace' => 'student-numeration-development-scope', 'prefix' => 'student-numeration-development-scope', 'as' => 'student-numeration-development-scope.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [StudentNumerationDevelopmentScope::class, 'index'])->name('index');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('store', [StudentNumerationDevelopmentScope::class, 'store'])->name('store');
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->post('update/{id}', [StudentNumerationDevelopmentScope::class, 'update'])->name('update');
    });

    

    Route::group(['namespace' => 'student-development-scoring', 'prefix' => 'student-development-scoring', 'as' => 'student-development-scoring.'], function () {
        Route::middleware(['auth:sanctum', 'role:Administrator,Participant'])->get('index', [ReferenceStudentDevelopmentScoringController::class, 'index'])->name('index');
    });
});