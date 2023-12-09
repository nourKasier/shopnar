<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        // Determine if the category will be a parent or child
        $isParent = fake()->boolean(70); // 70% chance of being a parent category

        $parentId = null;
        if (!$isParent) {
            // Get a random parent category
            $parentCategory = Category::whereNull('parent_id')->inRandomOrder()->first();
            $parentId = $parentCategory ? $parentCategory->id : null;
        }

        return [
            'name' => fake()->word,
            'image' => fake()->imageUrl(),
            'parent_id' => $parentId,
        ];
    }
}
