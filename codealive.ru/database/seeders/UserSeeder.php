<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'surname' => Str::random(10),
        //     'name' => Str::random(10),
        //     'patronymic' => Str::random(10),
        //     'tel' => Str::random(17),
        //     'birthday_date' => Date::random(17),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        // User::query()->create(
        //     [
        //         'surname' => Str::surname,
        //         'name' => Str::random(10),
        //         'patronymic' => Str::random(10),
        //         'tel' => Str::random(17),
        //         'birthday_date' => Date::random(17),
        //         'email' => Str::random(10) . '@gmail.com',
        //         'password' => Hash::make('password'),

        //     ]
        // );
    }
}
