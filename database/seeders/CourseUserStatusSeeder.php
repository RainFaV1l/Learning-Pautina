<?php

namespace Database\Seeders;

use App\Models\CourseUsersStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseUserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseUsersStatus::query()->create([
            'id' => 1,
            'name' => 'Отклонен'
        ]);

        CourseUsersStatus::query()->create([
            'id' => 2,
            'name' => 'В обработке'
        ]);

        CourseUsersStatus::query()->create([
            'id' => 3,
            'name' => 'Принят'
        ]);
    }
}
