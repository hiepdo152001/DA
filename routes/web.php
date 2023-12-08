<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/auth/google/url', [AuthController::class, 'googleLoginUrl']);
Route::get('/auth/google/callback', [AuthController::class, 'loginCallback']);

Auth::routes();

Route::get('/login',function(){
    return view('welcome');
})->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');

Route::get('/home/profile', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');
Route::get('/home/edit', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');
Route::get('/home/order', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');
Route::get('/home/bills', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB,Sale');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB,Sale');
Route::get('/admin/bills', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/system', [App\Http\Controllers\HomeController::class, 'index'])->name('systemAdmin')->middleware('checkRole:systemAdmin');
Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('calendars')->middleware('checkRole:systemAdmin,admin,IB,Sale,user');

Route::get('/admin/booking', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');

