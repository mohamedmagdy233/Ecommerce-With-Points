<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'award_points' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::factory(),
            'image' => 'uploads/products/img.png',
            'quantity' => $this->faker->numberBetween(1, 100),
            'admin_id' => Admin::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
