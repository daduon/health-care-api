<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AppointmentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('profile', 'profile');
    Route::post('user-add-info', 'userAddInfo');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(MaterialController::class)->group(function () {
    Route::post('create-material', 'store');
    Route::get('edit-material/{id}', 'edit');
    Route::get('list-material', 'index');
    Route::post('update-material/{id}', 'update');
    Route::delete('delete-material/{id}', 'delete');
    Route::post('status-material/{id}', 'appointmentStatus');
});

Route::controller(AppointmentController::class)->group(function () {
    Route::post('create-appointment', 'store');
    Route::get('edit-appointment/{id}', 'edit');
    Route::post('update-appointment/{id}', 'update');
    Route::delete('delete-appointment/{id}', 'delete');
    Route::get('list-appointment', 'index');
});