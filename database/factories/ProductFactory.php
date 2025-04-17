<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_name = $this->faker->unique()->words($nb = 2, $asText = true); // Corrected spacing and syntax
        $slug = Str::slug($product_name); // Corrected capitalization of Str and variable name
         $image_name = $this->faker->numberBetween(1,24).'.jpg'; 

         
        return [
            'name' => Str::title($product_name), // Corrected arrow syntax
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->randomFloat(1,22), // Generates a random price between 10 and 100
            'SKU' => 'SKU' . $this->faker->unique()->numberBetween(100, 200), // Unique SKU
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 200), // Corrected capitalization of 'Quantity'
            'image' => $image_name, 
            'images' => $image_name, 

            'category_id' => $this->faker->numberBetween(1, 6), // Assumes you have 6 categories
        ];
    }
}