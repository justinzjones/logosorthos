<?php

use App\Http\Controllers\API\AtcFeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ATC Feedback routes - no authentication required
Route::post('/atc-feedback', [AtcFeedbackController::class, 'store']);
Route::get('/atc-feedback', [AtcFeedbackController::class, 'index']);
