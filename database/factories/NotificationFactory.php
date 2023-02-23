<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tabel_id' => mt_rand(1, 4),
            'title' => fake()->sentence(),
            'body' => $this->faker->sentence(mt_rand(2, 8))
        ];
    }
}
