<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'password' => Hash::make('password'),
            'address' => $this->faker->address(),
            'points' => $this->faker->numberBetween(0, 1000),
            'referral_code' => Str::random(10),
            'link' => $this->faker->unique()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
