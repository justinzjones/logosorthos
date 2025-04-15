<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Define the URL and headers
        $url = env('DIRECTUS_API_URL', 'http://directus:8055') . '/items/articles';
        $headers = [
            'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer token', // Uncomment if needed
        ];

        // Make the HTTP GET request using Laravel's HTTP client
        $response = Http::withHeaders($headers)->get($url);

        // Handle the response
        if ($response->successful()) {
            $articles = $response->json();
            dd($articles);
        } else {
            // Handle errors
            return response()->json([
                'error' => 'Failed to fetch articles',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
