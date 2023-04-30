<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\LessonFile;
use App\Models\LessonFilesBundle;
use App\Models\LessonUsersStatus;
use App\Models\LessonVideo;
use App\Models\LessonVideosBundle;
use App\Models\User;
use App\Models\UserModule;
use App\Models\UserModulesStatus;
use App\Models\UserRole;
use Database\Factories\LessonUsersStatusesFactory;
use Faker\Provider\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Вызов seeder

        $this->call(RoleSeeder::class);

        $this->call(CourseCategorySeeder::class);

        $this->call(CourseLevelSeeder::class);

        $this->call(CourseUserStatusSeeder::class);


        // Создание основных пользователей

        User::factory()->create([
            'name' => 'Админ',
            'surname' => 'Админ',
            'patronymic' => 'Админ',
            'tel' => '+7 (000) 000 0000',
            'role_id' => 3,
            'birthday_date' => '2023-03-12',
            'last_auth_date' => '2023-03-01',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminadmin')
        ]);

        User::factory()->create([
            'name' => 'Пользователь',
            'surname' => 'Пользователь',
            'patronymic' => 'Пользователь',
            'tel' => '+7 (000) 000 0001',
            'role_id' => 1,
            'birthday_date' => '2023-03-12',
            'last_auth_date' => '2023-03-01',
            'email' => 'user@example.com',
            'password' => Hash::make('useruser')
        ]);

        User::factory()->create([
            'name' => 'Преподаватель',
            'surname' => 'Преподаватель',
            'patronymic' => 'Преподаватель',
            'tel' => '+7 (000) 000 0002',
            'role_id' => 2,
            'birthday_date' => '2023-03-12',
            'last_auth_date' => '2023-03-01',
            'email' => 'prepod@example.com',
            'password' => Hash::make('prepodprepod')
        ]);

        // Создание статусов модуля

        UserModulesStatus::factory()->create(['name' => 'Удален']);
        UserModulesStatus::factory()->create(['name' => 'Проходит']);
        UserModulesStatus::factory()->create(['name' => 'Прошел']);

        // Создание статусов урока

        LessonUsersStatus::factory()->create(['name' => 'Отклонен']);
        LessonUsersStatus::factory()->create(['name' => 'В проверке']);
        LessonUsersStatus::factory()->create(['name' => 'Выполнен']);

        // Использование factory

        User::factory(10)->create();

        Course::factory(10)->create();

        Group::factory(10)->create();

        Lesson::factory(10)->create();

        LessonFile::factory(10)->create();

        LessonFilesBundle::factory(10)->create();

        LessonVideo::factory(10)->create();

        LessonVideosBundle::factory(10)->create();

    }
}
