<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Waste;
use App\Models\WasteSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Waste>
 */
class WasteFactory extends Factory
{
    protected $model = Waste::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomFloat(2, 1, 100),
            'points_transferred' => $this->faker->numberBetween(1, 1000),
            'waste_section_id' => WasteSection::factory(),
            'admin_id' => Admin::factory(),
            'customer_id' => Customer::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
