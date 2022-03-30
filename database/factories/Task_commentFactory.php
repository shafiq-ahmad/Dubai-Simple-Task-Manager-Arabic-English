<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task_comment>
 */
class Task_commentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_id' => $this->faker->numberBetween(1,20),
            'by' => $this->faker->randomElement(['Admin', 'Company']),
            'comment' => $this->faker->sentence,
            'created_at' => $this->faker->datetime,
            'updated_at' => $this->faker->datetime,
        ];
    }
}
