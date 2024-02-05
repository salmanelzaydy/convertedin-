<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TaskFactory extends Factory
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
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'assigned_to_id' => function () {
                // Assuming you have User model and want to assign the task to a user
                return \App\Models\User::factory()->create()->id;
            },
            'assigned_by_id' => function () {
                // Assuming you have User model and want to set the assigned_by_id
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
