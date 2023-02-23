<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inmessage>
 */
class InmessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => mt_rand(1, 3),
            'about' => fake()->sentence(),
            'title' => fake()->sentence(),
            'body' => '<p>'.implode('<p></p>',$this->faker->paragraphs(mt_rand(3, 4))).'</p>',
        ];
    }
}
