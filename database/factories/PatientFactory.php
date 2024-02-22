<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'date_of_birth' => fake()->dateTime,
            'owner_id' => function () {
                return Owner::factory()->create()->id;
            },
            'type' => fake()->word,
        ];
    }
}
