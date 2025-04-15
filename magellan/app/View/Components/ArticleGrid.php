<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleGrid extends Component
{
    /**
     * The articles to display.
     *
     * @var array
     */
    public $articles;

    /**
     * Create a new component instance.
     *
     * @param  array  $articles
     * @return void
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.article-grid');
    }
} 