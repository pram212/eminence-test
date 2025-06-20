<?php

namespace Database\Factories;

use App\Models\Severity;
use App\Models\Status;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            "title" => $this->faker->word(),
            "description" => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            "status_id" => Status::inRandomOrder()->first()->id,
            "severity_id" => Severity::inRandomOrder()->first()->id,
            "user_id" => User::where("role", "developer")->inRandomOrder()->first()->id,
        ];
    }
}
