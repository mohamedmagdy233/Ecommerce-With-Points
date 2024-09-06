<?php

namespace Database\Factories;

use App\Models\WasteSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WasteSection>
 */
class WasteSectionFactory extends Factory
{
    protected $model = WasteSection::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'point_per_one' => $this->faker->randomFloat(2, 0, 100), // Random points per one item (nullable)
            'image' => 'uploads/waste-section/img.png',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
