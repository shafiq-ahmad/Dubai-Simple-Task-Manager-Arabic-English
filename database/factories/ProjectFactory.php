<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'desc' => $this->faker->paragraph,
            'company_id' => $this->faker->numberBetween(1,10),
            'deadline' => $this->faker->datetime,
            'created_at' => $this->faker->datetime,
            'updated_at' => $this->faker->datetime,
        ];
    }
}
