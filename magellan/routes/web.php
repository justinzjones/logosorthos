<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

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

// Sitemap route
Route::get('/sitemap.xml', function() {
    $controller = new ArticleController();
    $articles = $controller->fetchArticles('http://directus:8055/items/articles?fields=*,category.name');
    
    $content = View::make('sitemap', [
        'articles' => $articles
    ]);
    
    return Response::make($content, '200')->header('Content-Type', 'text/xml');
});

// Include test routes
include_once __DIR__ . '/test.php';