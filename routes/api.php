<?php

use Illuminate\Http\Request;
use App\Imports\ImportKaryawan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\UnitKerjaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users/register/',  [UserController::class, 'create']);
Route::post('/users/login', [UserController::class, 'login']);

Route::get('/unit-kerja', [UnitKerjaController::class, 'index']);
Route::post('/unit-kerja', [UnitKerjaController::class, 'create']);
Route::post('/unit-kerja/{id}/update', [UnitKerjaController::class, 'update']);
Route::delete('/unit-kerja/{id}/delete', [UnitKerjaController::class, 'delete']);

Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::post('/karyawan', [KaryawanController::class, 'create']);
Route::post('/karyawan/import', [KaryawanController::class, 'import']);
Route::post('/karyawan/{id}/update', [KaryawanController::class, 'update']);
Route::delete('/karyawan/{id}/delete', [KaryawanController::class, 'delete']);
