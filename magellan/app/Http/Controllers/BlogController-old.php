<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $headers = [
            'Content-Type' => 'application/json',
            // 'AccessToken' => 'key',
            // 'Authorization' => 'Bearer token',
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);

        // $url = 'http://localhost:8055/items/posts/'.$id;
        // $url = 'http://localhost/wp/v2/posts/'.$id;
        // $url = 'http://wp-magellan.localhost/wp-json/wp/v2/posts/'.$id;
        // $url = 'http://localhost:8055/items/posts/'.$id.'/?fields=*,author.first_name,author.last_name,author.photo';
        $url = 'http://0.0.0.0:8055/items/articles';
        
        $response = $client->request('GET', $url, [
        'headers' => [
        'Content-Type' => 'application/json'
        ]
        // 'body' => $json_rq
        ]);
        
        //get the content from the body of the response
        // dd(json_decode(($response->getBody()->getContents())));
        // $post_tmp = $response->getBody()->getContents();
        $articles = json_decode(($response->getBody()->getContents()));
        dd($articles);
        // return view('blog_posts')->with('posts', $posts);
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
