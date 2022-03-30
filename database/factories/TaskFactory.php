<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1,50),
            'title' => $this->faker->name,
            'status' => $this->faker->randomElement(\App\Models\Task::$statuses),
            'user' => 'Admin',
            'desc' => $this->faker->paragraph,
            'due_date' => $this->faker->datetime,
            'completed_at' => $this->faker->datetime,
            'created_at' => $this->faker->datetime,
            'updated_at' => $this->faker->datetime,
        ];
    }
}
