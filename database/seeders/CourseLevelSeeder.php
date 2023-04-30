<?php

namespace Database\Seeders;

use App\Models\CourseLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseLevel::query()->create([
            'name' => 'Базовый'
        ]);

        CourseLevel::query()->create([
            'name' => 'Средний'
        ]);

        CourseLevel::query()->create([
            'name' => 'Сложный'
        ]);
    }
}
