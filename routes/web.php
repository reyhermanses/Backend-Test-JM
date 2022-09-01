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
    return view('home');
});

// Auth::routes();

// Route::get('/login', function(){
//     return view('auth.login');
// });

Route::get('login', [App\Http\Controllers\HomeController::class, 'login']);

Route::get('/employee', [App\Http\Controllers\HomeController::class, 'employee']);
Route::get('/unit', [App\Http\Controllers\HomeController::class, 'unit']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('employee');

// Auth::routes();

Route::get('/home', function () {
    return view('home');
});


Route::get('/menu/{menu?}', [App\Http\Controllers\HomeController::class, 'menu']);
