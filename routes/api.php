<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\SensorMeasurementController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\TypeMeasurementController;
use App\Http\Controllers\TypeSensorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('sucursals', SucursalController::class);
    Route::apiResource('type-measurements', TypeMeasurementController::class);
    Route::apiResource('type-sensors', TypeSensorController::class);
    Route::apiResource('sensors', SensorController::class);
    Route::post('change-state-sensor', [SensorController::class, 'changeStateSensor']);
    Route::get('/sensors-measurements/{id}', [SensorMeasurementController::class, 'measurementsBySensor']);
    //Agregar a permisos
    Route::get('reports/sucursals', [ReportController::class, 'getSucursalsAction']);
    Route::get('reports/alerts', [ReportController::class, 'getAlertsAction']);
    Route::get('reports/by-alert', [ReportController::class, 'getByAlertAction']);
});

Route::post('/sensors-measurements', [SensorMeasurementController::class, 'createMeasurementsBySensor']);
