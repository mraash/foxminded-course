<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Report\ReportController;
use App\Http\Controllers\Api\V1\Report\DriversController;

Route::prefix('/v1')->group(function () {

    Route::prefix('/report')->group(function () {

        Route::get('/', [ReportController::class, 'index']);

        Route::get('/drivers/{abbreviation}', [DriversController::class, 'single']);
    });
});
