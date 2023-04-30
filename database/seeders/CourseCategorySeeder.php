<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseCategory::query()->create([
            'name' => 'Веб-разработка'
        ]);

        CourseCategory::query()->create([
            'name' => 'Веб-дизайн'
        ]);

        CourseCategory::query()->create([
            'name' => 'Программрование'
        ]);

        CourseCategory::query()->create([
            'name' => 'Видеопроизводство'
        ]);
    }
}
