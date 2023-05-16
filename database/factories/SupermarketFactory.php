<?php

namespace Database\Factories;

use App\Models\Supermarket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supermarket>
 */
class SupermarketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'location_id' => 1,
        ];
    }
}
