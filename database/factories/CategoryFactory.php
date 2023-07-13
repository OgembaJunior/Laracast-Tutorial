<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

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

    protected $model = Category::class;

    public function definition(): array
    {

  
        $categories = ['Politics', 'Technology', 'Sports', 'Business'];
        $slug = Str::slug($categories[array_rand($categories, 1)]);
    
            return [
                'name' => $categories[array_rand($categories, 1)],
                'slug' => $slug,
            ];
    }
}
