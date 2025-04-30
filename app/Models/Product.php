<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'discount',
        'SKU',
        'stock_status',
        'featarured',
        'quantity',
        'image',
        'images',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists')
            ->withTimestamps();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function totalRatings()
    {
        return $this->ratings()->count();
    }
}
