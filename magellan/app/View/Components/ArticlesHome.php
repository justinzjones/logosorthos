<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticlesHome extends Component
{
    /**
     * The articles to display.
     */
    public $articles;

    /**
     * Create a new component instance.
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.articles--home');
    }
} 