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
Route::get('/dn', [App\Http\Controllers\HomeController::class, 'index'])
->name('dn');
Route::get('/dn/profile', [App\Http\Controllers\HomeController::class, 'index'])
->name('dn');
Route::get('/dn/edit', [App\Http\Controllers\HomeController::class, 'index'])
->name('dn');
Route::get('/dn/order', [App\Http\Controllers\HomeController::class, 'index'])
->name('dn');
Route::get('/dn/bills', [App\Http\Controllers\HomeController::class, 'index'])
->name('dn');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB,Sale');
Route::get('/admin/holiday', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin');
Route::get('/admin/holiday', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin');
Route::get('/admin/list/user', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/admin/list/register', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/admin/statistical', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/admin/list/user', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/admin/category', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/admin/product', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB');
Route::get('/admin/product/add', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB');
Route::get('/admin/booking', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB');
Route::get('/admin/product/import', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,IB');
Route::get('/admin/add/bill', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin,Sale');







Route::get('/admin/bills', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');
Route::get('/system', [App\Http\Controllers\HomeController::class, 'index'])->name('systemAdmin')->middleware('checkRole:systemAdmin');
Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('calendars')->middleware('checkRole:systemAdmin,admin,IB,Sale,user');

Route::get('/admin/booking', [App\Http\Controllers\HomeController::class, 'index'])->name('admin')->middleware('checkRole:systemAdmin,admin');

