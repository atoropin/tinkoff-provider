<?php

use Illuminate\Support\Facades\Route;

Route::post('notification', [TinkoffController::class, 'notification']);

Route::get('success', [TinkoffController::class, 'success']);
Route::get('fail', [TinkoffController::class, 'fail']);
