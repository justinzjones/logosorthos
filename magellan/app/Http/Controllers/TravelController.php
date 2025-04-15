<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TravelController extends Controller
{
    /**
     * Base URL for the API.
     */
    protected $baseUrl;
    
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->baseUrl = env('DIRECTUS_API_URL', 'http://directus:8055') . '/items';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Show a country by its ISO code.
     */
    public function show_country(string $id)
    {
        $url = "{$this->baseUrl}/countries/{$id}/?fields=ISO_31661_alpha2,name,preamble,hero,description,
                fk_region.id,fk_region.name,
                fk_place.id,fk_place.name,fk_place.intro,fk_place.hero,fk_place.priority";

        // Make the HTTP GET request
        $response = Http::get($url);
         // Debugging the raw response
        // dd($response->json());

        // Check for errors
        if ($response->failed() || !$response->json('data')) {
            Log::error("Country not found: {$id}");
            abort(404, 'Country not found');
        }

        // Convert the country data to an object
        $country = json_decode(json_encode($response->json('data')));
        // dd($country);
      

        // Pass the country object to the view
        $country->type = 'country';
        return view('travel-template-1')->with('location', $country);
    }

    /**
     * Show a region.
     */
    public function show_region_old(string $id)
    {
        $url = "{$this->baseUrl}/regions/{$id}/?fields=id,name,preamble,hero,description";

        // Make the HTTP GET request
        $response = Http::get($url);
         // Debugging the raw response
        // dd($response->json());

        // Check for errors
        if ($response->failed() || !$response->json('data')) {
            Log::error("Region not found: {$id}");
            abort(404, 'Region not found');
        }

        // Convert the country data to an object
        $region = json_decode(json_encode($response->json('data')));
        // dd($region);
      

        // Pass the region object to the view
        $region->type = 'region';
        return view('travel-template-1')->with('location', $region);
    }

    public function show_region(string $id)
    {
        $url = "{$this->baseUrl}/regions/{$id}/?fields=id,name,preamble,hero,description";

        // Make the HTTP GET request
        $response = Http::get($url);
         // Debugging the raw response
        // dd($response->json());

        // Check for errors
        if ($response->failed() || !$response->json('data')) {
            Log::error("Region not found: {$id}");
            abort(404, 'Region not found');
        }

        // Convert the country data to an object
        $region = json_decode(json_encode($response->json('data')));
        // dd($region);
      

        // Pass the country object to the view
        $region->type = 'region';
        return view('travel-template-1')->with('location', $region);
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