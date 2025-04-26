<div class="star-rating">
    @for ($i = 1; $i <= $maxRating; $i++)
        @if ($i <= $rating)
            <i class="fas fa-star theme-color"></i>
        @elseif($i - 0.5 <= $rating)
            <i class="fas fa-star-half-alt theme-color"></i>
        @else
            <i class="far fa-star"></i>
        @endif
    @endfor

    @if (isset($productId))
        <span class="rating-count">({{ $totalRatings ?? '' }})</span>
    @endif
</div>
