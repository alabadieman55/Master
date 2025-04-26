<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarRating extends Component
{
    public $rating;
    public $maxRating;
    public $productId;

    public function __construct($rating = 0, $maxRating = 5, $productId = null)
    {
        $this->rating = $rating;
        $this->maxRating = $maxRating;
        $this->productId = $productId;
    }

    public function render()
    {
        return view('components.star-rating');
    }
}
