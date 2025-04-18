<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    protected $baseUrl;
    protected $maxRetries = 2;
    
    public function __construct()
    {
        $this->baseUrl = env('DIRECTUS_API_URL', 'http://directus:8055') . '/items/articles';
    }

    public function index()
    {
        // Get 4 latest news articles
        $newsUrl = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_eq]=news&sort=-date_created&limit=4";
        $newsArticles = $this->fetchArticles($newsUrl);
        
        // Get 6 latest articles from other categories
        $otherUrl = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_nin]=news&sort=-date_created&limit=6";
        $otherArticles = $this->fetchArticles($otherUrl);
        
        // Sort each article group by date (most recent first)
        usort($newsArticles, function($a, $b) {
            return strtotime($b->date_created) - strtotime($a->date_created);
        });
        
        usort($otherArticles, function($a, $b) {
            return strtotime($b->date_created) - strtotime($a->date_created);
        });
        
        // Place news articles first, followed by other articles
        $articles = array_merge($newsArticles, $otherArticles);
        
        return view('home', ['articles' => $articles]);
    }

    public function index_news()
    {
        $url = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_eq]=news&sort=-date_created";
        $articles = $this->fetchArticles($url);

        return view('home', [
            'articles' => $articles,
            'current_category' => 'News'
        ]);
    }

    public function index_discovery()
    {
        $url = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_eq]=discovery&sort=-date_created";
        $articles = $this->fetchArticles($url);

        return view('home', [
            'articles' => $articles,
            'current_category' => 'Discovery'
        ]);
    }

    public function index_aviation()
    {
        $url = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_eq]=aviation&sort=-date_created";
        $articles = $this->fetchArticles($url);

        return view('home', [
            'articles' => $articles,
            'current_category' => 'Aviation'
        ]);
    }

    public function index_finance()
    {
        $url = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_eq]=finance&sort=-date_created";
        $articles = $this->fetchArticles($url);

        return view('home', [
            'articles' => $articles,
            'current_category' => 'Finance'
        ]);
    }

    public function index_history()
    {
        $url = "{$this->baseUrl}?fields=*,featured_image,category.name,category.color,author.first_name,author.last_name,author.avatar&filter[category][name][_eq]=history&sort=-date_created";
        $articles = $this->fetchArticles($url);

        return view('home', [
            'articles' => $articles,
            'current_category' => 'History'
        ]);
    }

    public function show(string $category, string $article)
    {
        $url = "{$this->baseUrl}/{$article}?fields=id,title,content,date_created,featured_image,image,category.name,author.last_name,author.first_name,author.avatar";
        
        Log::info("Fetching article", ['url' => $url]);
        $response = Http::get($url);

        if ($response->failed() || !$response->json('data')) {
            Log::error('Article not found or request failed', [
                'id' => $article,
                'status' => $response->status(),
                'response' => $response->body()
            ]);
            abort(404, 'Article not found');
        }

        $articleData = json_decode(json_encode($response->json('data')));

        if (strtolower($category) !== strtolower($articleData->category->name)) {
            Log::info("Redirecting to correct category", [
                'requested' => $category, 
                'actual' => $articleData->category->name
            ]);
            
            return redirect()->route('articles.show', [
                'category' => strtolower($articleData->category->name),
                'article' => $articleData->id,
            ]);
        }

        // First try to fetch related articles from the same category
        $relatedUrl = "{$this->baseUrl}?fields=id,title,content,date_created,featured_image,image,category.name&filter[category][name][_contains]={$articleData->category->name}&filter[id][_neq]={$article}&sort=-date_created&limit=3";
        
        Log::info("Fetching related articles", ['url' => $relatedUrl]);
        $related_articles = $this->fetchArticles($relatedUrl);

        // If no related articles found, fetch recent articles from any category
        if (empty($related_articles)) {
            Log::info("No related articles found, fetching recent articles instead");
            $recentUrl = "{$this->baseUrl}?fields=id,title,content,date_created,featured_image,image,category.name&filter[id][_neq]={$article}&sort=-date_created&limit=3";
            $related_articles = $this->fetchArticles($recentUrl);
        }

        return view('article', [
            'article' => $articleData,
            'category' => $category,
            'related_articles' => $related_articles,
        ]);
    }

    private function fetchArticles(string $url)
    {
        $response = Http::get($url);

        if ($response->failed()) {
            Log::error('Failed to fetch articles', ['url' => $url, 'status' => $response->status()]);
            return [];
        }

        // Convert the data array to objects
        $articles = $response->json('data') ?? [];
        return json_decode(json_encode($articles));
    }
}