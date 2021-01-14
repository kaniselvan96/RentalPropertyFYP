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

//public
Route::post('/allhouse', [App\Http\Controllers\PublicController::class, 'allhouse'])->name('allhouse');
Route::get('/publicviewhouse/{id}', [App\Http\Controllers\PublicController::class, 'publicviewhouse'])->name('publicviewhouse');

//house
Route::get('/listhouse', [App\Http\Controllers\HomeController::class, 'list'])->name('listhome');
Route::get('/viewhouse/{id}', [App\Http\Controllers\HomeController::class, 'view'])->name('viewhome');
Route::get('/edithouse/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edithome');
Route::get('/createhouse', [App\Http\Controllers\HomeController::class, 'create'])->name('createhome');
Route::post('/storehouse', [App\Http\Controllers\HomeController::class, 'store'])->name('storehome');
Route::post('/updatehouse/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('storehome');
Route::post('/myhouse', [App\Http\Controllers\HomeController::class, 'myhouse'])->name('myhouse');

Route::post('/getreminder', [App\Http\Controllers\HomeController::class, 'getreminder'])->name('getreminder');
Route::post('/deletereminder', [App\Http\Controllers\HomeController::class, 'deletereminder'])->name('deletereminder');

//photo
Route::get('/photohouse/{id}', [App\Http\Controllers\PhotoController::class, 'photohouse'])->name('photohouse');
Route::post('/photostore', [App\Http\Controllers\PhotoController::class, 'photostore'])->name('photostore');
Route::post('/photoremove', [App\Http\Controllers\PhotoController::class, 'photoremove'])->name('photoremove');

//property
Route::get('/property', [App\Http\Controllers\PropertyController::class, 'list'])->name('property');
Route::post('/requestproperty', [App\Http\Controllers\PropertyController::class, 'requestproperty'])->name('requestproperty');
Route::get('/requestpropertylist', [App\Http\Controllers\PropertyController::class, 'requestpropertylist'])->name('requestpropertylist');
Route::post('/requestpropertystatus', [App\Http\Controllers\PropertyController::class, 'requestpropertystatus'])->name('requestpropertystatus');
Route::post('/requestpropertymainstatus', [App\Http\Controllers\PropertyController::class, 'requestpropertymainstatus'])->name('requestpropertymainstatus');

//tenant
Route::get('/addtenant/{id}', [App\Http\Controllers\TenantController::class, 'addtenant'])->name('addtenant');
Route::get('/viewtenant/{id}', [App\Http\Controllers\TenantController::class, 'viewtenant'])->name('viewtenant');
Route::post('/storeaddtenant', [App\Http\Controllers\TenantController::class, 'storeaddtenant'])->name('storeaddtenant');
Route::post('/deletetenant', [App\Http\Controllers\TenantController::class, 'deletetenant'])->name('deletetenant');

//invoice
Route::get('/invoicelist', [App\Http\Controllers\InvoiceController::class, 'invoicelist'])->name('invoicelist');
Route::get('/invoicecreate/{id}', [App\Http\Controllers\InvoiceController::class, 'invoicecreate'])->name('invoicecreate');
Route::get('/invoiceedit/{id}/{serviceid}', [App\Http\Controllers\InvoiceController::class, 'invoiceedit'])->name('invoiceedit');
Route::get('/invoiceview/{id}', [App\Http\Controllers\InvoiceController::class, 'invoiceview'])->name('invoiceview');
Route::post('/storeinvoice', [App\Http\Controllers\InvoiceController::class, 'storeinvoice'])->name('storeinvoice');
Route::post('/storeinvoiceauto', [App\Http\Controllers\InvoiceController::class, 'storeinvoiceauto'])->name('storeinvoiceauto');
Route::post('/editinvoice', [App\Http\Controllers\InvoiceController::class, 'editinvoice'])->name('editinvoice');
Route::post('/reminder', [App\Http\Controllers\InvoiceController::class, 'reminder'])->name('reminder');
Route::post('/deleteinvoice', [App\Http\Controllers\InvoiceController::class, 'deleteinvoice'])->name('deleteinvoice');

//tenant invoice
Route::get('/invoicetenantlist', [App\Http\Controllers\InvoiceController::class, 'invoicetenantlist'])->name('invoicetenantlist');
Route::post('/payinvoice', [App\Http\Controllers\InvoiceController::class, 'payinvoice'])->name('payinvoice');

//service tenant
Route::get('/servicelist', [App\Http\Controllers\ServiceController::class, 'servicelist'])->name('servicelist');
Route::get('/servicecreate/{id}', [App\Http\Controllers\ServiceController::class, 'servicecreate'])->name('servicecreate');
Route::post('/servicestore', [App\Http\Controllers\ServiceController::class, 'servicestore'])->name('servicestore');

//service Landlord
Route::get('/servicelandlordlist', [App\Http\Controllers\ServiceController::class, 'servicelandlordlist'])->name('servicelandlordlist');
Route::post('/servicecstorecharge', [App\Http\Controllers\ServiceController::class, 'servicecstorecharge'])->name('servicecstorecharge');
Route::post('/servicechangestatus', [App\Http\Controllers\ServiceController::class, 'servicechangestatus'])->name('servicechangestatus');
Route::get('/servicepage', [App\Http\Controllers\ServiceController::class, 'servicepage'])->name('servicepage');
