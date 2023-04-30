<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->text(50),
            'task' => fake()->text(100),
            'lesson_number' => fake()->numberBetween(1, 10),
            'course_id' => fake()->numberBetween(1, 10),
        ];
    }
}
