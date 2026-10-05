<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\SensorS3Controller;
use App\Http\Controllers\AnalysisController;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard/chart-data', [DashboardController::class, 'getSensorChartData']);
Route::get('/dashboard/s3-chart-data', [DashboardController::class, 'getSensorS3ChartData']);
Route::get('/sensor', [SensorController::class, 'sensor']);
Route::get('/sensor/chart-data', [SensorController::class, 'getSensorChartData']);
Route::get('/sensor-s3', [SensorS3Controller::class, 'index']);
Route::get('/api/sensor/last', [SensorController::class, 'getLastSensor']);
Route::get('/api/sensor/all', [SensorController::class, 'getAllSensor']);
Route::get('/api/sensor-s3/last', [SensorS3Controller::class, 'getLastSensor']);
Route::get('/api/sensor-s3/all', [SensorS3Controller::class, 'getAllSensor']);
Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis');
Route::get('/api/analysis/matlab', [AnalysisController::class, 'getMatlabData']);
Route::get('/api/analysis/anfis', [AnalysisController::class, 'getAnfisData']);
