<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = fake()->randomElement(['male', 'female']);
        return [
            'nama' => fake()->name(),
            'jk' => $gender,
            'alamat' => fake()->address(),
            'email' => fake()->email(),
            'no_telp' => fake()->phoneNumber(),
            'job_id' => mt_rand(1, 3)
        ];
    }
}
