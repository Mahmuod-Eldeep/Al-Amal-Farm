<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\Farmer;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(1, 5000),
            'stock' => $this->faker->numberBetween(1, 5000),
            'farmer_id' => Farmer::factory(),
            'categories_id' => category::factory()


        ];
    }
}
