<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'name' => $this->faker->text(mt_rand(10, 16)),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->randomNumber(5, true),
            'desc' => $this->faker->sentence(mt_rand(2, 8)),
            'category_id' => mt_rand(2, 3)
        ];
    }
}
