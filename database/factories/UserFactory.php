<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\City;
use App\Models\Role;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
    
       // Get all existing role IDs
       $roleIds = Role::where('id', '!=', 1)->pluck('id')->toArray();
    
        // Get all existing city IDs (assuming cities are already seeded in your database)
        $cityIds = City::pluck('id')->toArray();
    
        // Randomly select a role ID and city ID
        $roleId = $this->faker->randomElement($roleIds);
        $cityId = $this->faker->randomElement($cityIds);
    
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Change as needed
            'DOB' => $this->faker->date(),
            'role_id' => $roleId,
            'city_id' => $cityId,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
