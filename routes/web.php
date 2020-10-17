<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//house
Route::get('/listhouse', [App\Http\Controllers\HomeController::class, 'list'])->name('listhome');
Route::get('/viewhouse/{id}', [App\Http\Controllers\HomeController::class, 'view'])->name('viewhome');
Route::get('/edithouse/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edithome');
Route::get('/createhouse', [App\Http\Controllers\HomeController::class, 'create'])->name('createhome');
Route::post('/storehouse', [App\Http\Controllers\HomeController::class, 'store'])->name('storehome');
Route::post('/updatehouse/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('storehome');


//property
Route::get('/property', [App\Http\Controllers\PropertyController::class, 'list'])->name('property');
Route::post('/requestproperty', [App\Http\Controllers\PropertyController::class, 'requestproperty'])->name('requestproperty');