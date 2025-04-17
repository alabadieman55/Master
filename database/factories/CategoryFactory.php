<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory

{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_name = $this->faker->unique()->words($nb = 2, $asText = true); // Corrected spacing and syntax
        $slug = Str::slug($category_name); // Corrected capitalization of Str and variable name

        return [
            'name' => Str::title($category_name), // Corrected arrow syntax
            'slug' => $slug,
            'image' => $this->faker->numberBetween(1, 6).'.jpg', // Generates a random price between 10 and 100
           
        ];   
    }
}
