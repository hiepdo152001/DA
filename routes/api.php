<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HolidayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => '/calendar'], function () {
        Route::group(['prefix' => '/time-keep'], function () {
            Route::get('/all', [CalendarController::class, 'get']);
            Route::post('/check-in', [CalendarController::class, 'create']);
            Route::post('/check-out', [CalendarController::class, 'update']);
            Route::get('/by-day', [CalendarController::class, 'getByDay']);
            Route::get('/work-time', [CalendarController::class, 'getWorkTime']);
            Route::get('/not-work/{year}/{month}', [CalendarController::class, 'getNotWork']);
        });
        Route::group(['prefix' => '/holiday'], function () {
            Route::post('/',[HolidayController::class,'create'])->middleware('checkRole:systemAdmin');
            Route::get('/',[HolidayController::class,'get']);
            Route::get('/all',[HolidayController::class,'all']);
            Route::get('/{id}',[HolidayController::class,'get'])->middleware('checkRole:systemAdmin');
            Route::post('/{id}',[HolidayController::class,'update'])->middleware('checkRole:systemAdmin');
            Route::delete('/{id}',[HolidayController::class,'delete'])->middleware('checkRole:systemAdmin');
        });
        Route::group(['prefix' => '/requests'], function () {
            Route::get('/', [ContactController::class, 'getByUserLogin']);
            Route::post('/', [ContactController::class, 'create']);
            Route::get('/manager', [ContactController::class, 'getManager']);
            Route::get('/{id}', [ContactController::class, 'get']); 
            Route::patch('/{id}', [ContactController::class, 'setStatus']);
            Route::put('/{id}', [ContactController::class, 'edit']);
            Route::delete('/{id}', [ContactController::class, 'delete']);
            Route::get('/member/{type}', [ContactController::class, 'getStatus']);
        });
    });
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [AuthController::class, 'profile']);
        Route::get('/by/{id}', [AuthController::class, 'getById']);
        Route::get('/all', [AuthController::class, 'get'])->middleware('checkRole:systemAdmin');
    });
    
});
Route::get('/login', [AuthController::class, 'googleLoginUrl']);
Route::get('/sto', [AuthController::class, 'test']);


