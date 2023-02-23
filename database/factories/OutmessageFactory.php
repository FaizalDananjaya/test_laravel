<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Outmessage>
 */
class OutmessageFactory extends Factory
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
            'employee_id' => mt_rand(1, 3),
            'category_id' => mt_rand(10, 11),
            'title' => fake()->sentence(),
            'body' => '<p>'.implode('<p></p>',$this->faker->paragraphs(mt_rand(3, 4))).'</p>',
        ];
    }
}
