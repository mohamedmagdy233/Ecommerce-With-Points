<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'slug' => Str::slug($this->faker->unique()->word()),
            'image' => 'uploads/categories/img.png',
            'admin_id' => Admin::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
