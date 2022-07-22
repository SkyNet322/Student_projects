<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->truncate();
        
        $users = [
            ['Борисов', 'Вадим', 'Викторович'],
            ['Гордон', 'Саня', 'Александрович'],
            ['Русской', 'Коля', 'Рюрикович'],
            ['Зверь', 'Виктор', 'Маленович'],
            ['Забугорный', 'Ахмед', 'Константинович']
        ];

        foreach($users as $key => $user) {
            DB::table('users')->insert(
                [
                    'surname' => $user[0],
                    'name' => $user[1],
                    'patronymic' => $user[2],
                    'login' => 'manager' . ($key + 1),
                    'password' => Hash::make('12345')
                ]
                );
        }
    }
}
