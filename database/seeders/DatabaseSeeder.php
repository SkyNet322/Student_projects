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
            ['Выхлоп', 'Вадим', 'Викторович'],
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

       // DB::table('inflics')->truncate();

      /*  $data = [
            ['Стоимость инфраструктуры', 'CAPEX', 'Укажите общую стоимость инфраструктуры'],
            ['Стоимость инфраструктуры (облачная)', 'OPEX', 'Укажите общую стоимость инфраструктуры (облачной)'],
            ['Сопровождение инфраструктуры', 'CAPEX', 'Укажите общую стоимость сопровождения инфраструктуры (техническая поддержка инфраструктурного ПО и ФОТ обслуживающего персонала)'],
            ['Переферийное оборудование', 'OPEX', 'Укажите общую стоимость используемого переферийного оборудования в ИС'],
            ['Стоимость лицензий/программного обеспечения', 'CAPEX', 'Укажите общую стоимость лицензий/программного обеспечения самой информационной системы. Затраты берутся из контракта на программное обеспечение'],
            ['Стоимость технической поддержки информационной системы', 'OPEX', 'Укажите стоимость технической поддержки информационной системы. Затраты берутся из контракта на программное обеспечение'],
            ['Аутсорс информационной системы', 'OPEX', 'Укажите стоимость аутсорса информационной системы. Затраты берутся из контракта на аутсорс']
        ];*/

       /* foreach($data as $key => $dat) {
            DB::table('inflics')->insert(
                [
                    'item' => $dat[0],
                    'type' => $dat[1],
                    'description' => $dat[2],
                ]
            );
        }*/
    }
}
