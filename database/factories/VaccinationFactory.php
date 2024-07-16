<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HealthWorker;
use App\Models\Patient;
use App\Models\User;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccination>
 */
class VaccinationFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
    
        return [
            'patient_id' => function () {
                return Patient::factory()->create()->id;
            },
            'vax_Date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'vax_Status' => $this->faker->randomElement(['schedule', 'done']),
        ];
    }

}
