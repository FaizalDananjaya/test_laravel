<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id' => mt_rand(1, 6),
            'customer_id' => mt_rand(1, 3),
            'schedule' => fake()->dateTime(),
            'fnote' => $this->faker->sentence(mt_rand(1, 2)),
        ];
    }
}
