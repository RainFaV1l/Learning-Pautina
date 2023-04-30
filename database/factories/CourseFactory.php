<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
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
            'description' => fake()->text(100),
            'price' => fake()->numberBetween(1_000, 50_000),
            'author' => fake()->numberBetween(1, 13),
            'course_category_id' => fake()->numberBetween(1, 4),
            'course_level_id' => fake()->numberBetween(1, 3),
            'course_icon_path' => 'public/images/direction-banner.png',
        ];
    }
}
