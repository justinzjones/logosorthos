<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// Test route to confirm Directus API access - added comment for deploy test
Route::get('/test-directus', function () {
    $token = env('DIRECTUS_API_TOKEN');
    $url = env('DIRECTUS_API_URL') . '/items/articles?limit=3';
    $response = Http::withToken($token)->get($url);
    
    if ($response->successful()) {
        return $response->json();
    } else {
        return [
            'error' => 'Failed to fetch articles',
            'status' => $response->status(),
            'token' => $token,
            'url' => $url
        ];
    }
}); 