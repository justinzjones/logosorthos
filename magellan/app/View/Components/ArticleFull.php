<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ArticleFull extends Component
{
    /**
     * The article to display.
     */
    public $article;

    /**
     * Related articles to display.
     */
    public $related_articles;

    /**
     * Create a new component instance.
     */
    public function __construct($article, $related_articles = null)
    {
        $this->article = $article;
        $this->related_articles = $related_articles instanceof Collection 
            ? $related_articles 
            : collect($related_articles ?? []);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article--full');
    }
}
