<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('user_roles')->insert([
        //     'name' => 'Пользователь',
        // ]);
        // DB::table('user_roles')->insert([
        //     'name' => 'Преподаватель',
        // ]);
        // DB::table('user_roles')->insert([
        //     'name' => 'Администратор',
        // ]);
        UserRole::query()->create([
            'name' => 'Пользователь'
        ]);

        UserRole::query()->create([
            'name' => 'Преподаватель'
        ]);

        UserRole::query()->create([
            'name' => 'Администратор'
        ]);
    }
}
