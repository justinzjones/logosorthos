<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TravelController;

Route::get('/home', function () {
    return view('home');
});

Route::get('/', [ArticleController::class, 'index']);

Route::get('/news', [ArticleController::class, 'index_news']);

Route::get('/discovery', [ArticleController::class, 'index_discovery']);

Route::get('/aviation', [ArticleController::class, 'index_aviation']);

Route::get('/finance', [ArticleController::class, 'index_finance']);

Route::get('/history', [ArticleController::class, 'index_history']);

// Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('{category}/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('discovery/country/{id}', [TravelController::class, 'show_country']);
Route::get('discovery/region/{id}', [TravelController::class, 'show_region']);