<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReportNewController;
use App\Http\Controllers\StatsController;
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

Route::controller(EquipmentController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/equipment/{id}', 'show')->name('singleEquipmentPage');
    Route::post('/equipment', 'updateLocation')->name('updateLocation');
});

Route::controller(StatsController::class)->group(function () {
    Route::get('/stats', 'index')->name('stats');
});

Route::controller(ReportNewController::class)->group(function () {
    Route::get('/report-new', 'index')->name('reportNewPage');
    Route::post('/report-new', 'store')->name('storeNew');
});
