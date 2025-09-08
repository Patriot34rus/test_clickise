<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RuleController;
use Illuminate\Support\Facades\Route;

Route::prefix('rule')->group(function () {
    Route::put('create', [RuleController::class, 'create']);
    Route::get('list', [RuleController::class, 'list']);
    Route::get('settings', [RuleController::class, 'settings']);
});

Route::prefix('announcement')->group(function () {
    Route::get('stats/chart', [AnnouncementController::class, 'getStats']);
    Route::post('logs', [AnnouncementController::class, 'getLogs']);
    Route::get('list', [AnnouncementController::class, 'list']);
    Route::get('filter-data', [AnnouncementController::class, 'getFilterData']);
});
