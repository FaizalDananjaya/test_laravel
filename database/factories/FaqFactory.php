<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => mt_rand(8, 9),
            'question' => $this->faker->sentence(mt_rand(2, 4)),
            'answer' => $this->faker->paragraph(),
            'slug' => $this->faker->slug()
        ];
    }
}
