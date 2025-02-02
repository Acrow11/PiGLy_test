<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\WeightTargetController;


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


Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
Route::post('/weight_logs/create', [WeightLogController::class, 'store']);
Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])->name('weight_logs.update');
Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// ログアウトルート
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/weight_target/create', [WeightTargetController::class, 'create'])->name('weight_target.create');

Route::post('/weight_target/create', [WeightTargetController::class, 'store']);


Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSettingForm'])->name('weight_logs.goal_setting_form');
Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('weight_logs.goal_setting');

Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');