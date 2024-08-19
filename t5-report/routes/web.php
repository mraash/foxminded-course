<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Report\DriversController;
use App\Http\Controllers\Report\ReportController;

Route::redirect('/', '/report');

Route::prefix('/report')->group(function () {

    Route::get('/', [ReportController::class, 'index'])->name('report.index');

    Route::get('/drivers', [DriversController::class, 'index'])->name('report.drivers.index');
    Route::get('/drivers/{abbreviation}', [DriversController::class, 'single'])->name('report.drivers.single');
});
