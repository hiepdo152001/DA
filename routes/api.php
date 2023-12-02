<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ImportBookingController;
use App\Http\Controllers\Api\ProductsController;
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
            Route::post('/', [ContactController::class, 'create'])->middleware('checkRole:systemAdmin,admin,user,IB,Sale');
            Route::get('/manager', [ContactController::class, 'getManager'])->middleware('checkRole:systemAdmin,admin');
            Route::get('/{id}', [ContactController::class, 'get']);
            Route::post('/edit/{id}', [ContactController::class, 'edit'])->middleware('checkRole:systemAdmin,admin,user,IB,Sale');
            Route::delete('/{id}', [ContactController::class, 'delete'])->middleware('checkRole:systemAdmin,admin,user,IB,Sale');
        });
    });
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [UserController::class, 'profile']);
        Route::get('/by/{id}', [UserController::class, 'getById']);
        Route::get('/all', [UserController::class, 'get'])->middleware('checkRole:systemAdmin,admin');
        Route::put('/{id}', [UserController::class, 'update']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/{id}', [UserController::class, 'updateAvatar']);
        Route::put('/{id}/deActive', [UserController::class, 'deactive'])->middleware('checkRole:systemAdmin,admin');;
        Route::put('/{id}/active', [UserController::class, 'active'])->middleware('checkRole:systemAdmin,admin');
    });

    Route::group(['prefix' => '/category'], function () {
        Route::get('/', [CategoryController::class, 'get'])->middleware('checkRole:systemAdmin,admin');
        Route::get('/by/{id}', [CategoryController::class, 'get'])->middleware('checkRole:systemAdmin,admin');
        Route::put('/{id}', [CategoryController::class, 'update'])->middleware('checkRole:systemAdmin,admin');
        Route::post('/', [CategoryController::class, 'create'])->middleware('checkRole:systemAdmin,admin');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->middleware('checkRole:systemAdmin,admin');
    });

    Route::group(['prefix' => '/product'], function () {
        Route::get('/', [ProductsController::class, 'get'])->middleware('checkRole:systemAdmin,admin');
        Route::post('/{id}', [ProductsController::class, 'update'])->middleware('checkRole:systemAdmin,admin,IB');
        Route::post('/', [ProductsController::class, 'create'])->middleware('checkRole:systemAdmin,admin,IB');
        Route::get('/all', [ProductsController::class, 'all'])->middleware('checkRole:systemAdmin,admin,IB');
        
    });

    Route::group(['prefix' => '/bill'], function () {
        Route::get('/get', [ImportBookingController::class, 'get'])->middleware('checkRole:systemAdmin,admin,IB');
        Route::get('/by/{id}', [ImportBookingController::class, 'getById'])->middleware('checkRole:systemAdmin,admin,IB');
        Route::post('/{id}', [ImportBookingController::class, 'update'])->middleware('checkRole:systemAdmin,admin,IB');
        Route::post('/', [ImportBookingController::class, 'create'])->middleware('checkRole:systemAdmin,admin,IB');
        Route::get('/all', [ImportBookingController::class, 'all'])->middleware('checkRole:systemAdmin,admin,IB');
    });
   
});
Route::group(['prefix' => '/order'], function () {
    Route::get('/get', [CartController::class, 'get']);
    Route::get('/by/{id}', [CartController::class, 'getById']);
    Route::post('/update/{id}', [CartController::class, 'update']);
    Route::post('/create/{id}', [CartController::class, 'create']);
    Route::delete('/{id}', [CartController::class, 'delete']);
    
});
Route::get('/login', [AuthController::class, 'googleLoginUrl']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/alls', [ProductsController::class, 'alls']);
Route::get('/product/by/{id}', [ProductsController::class, 'get']);
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'
    ], 404);
});