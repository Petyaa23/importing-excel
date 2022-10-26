<?php

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
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::post('get-cars', [App\Http\Controllers\DashboardController::class, 'getCars'])->name('get.cars');


//Route::get('/file-import',[UserController::class,'importView'])->name('import-view');
//Route::post('/import',[UserController::class,'import'])->name('import');
//Route::get('/export-users',[UserController::class,'exportUsers'])->name('export-users');