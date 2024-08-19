<?php

use App\Http\Controllers\Api\V1\GroupsController;
use App\Http\Controllers\Api\V1\StudentsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('groups', GroupsController::class)->only(['index']);
    Route::apiResource('students', StudentsController::class)->except(['update']);
});
