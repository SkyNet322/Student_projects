<?php

namespace App\Http\Controllers;

use App\Models\inflic;
use App\Models\personnel;
use App\Models\calculate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Illuminate\Support\Facades\Auth;
use function Ramsey\Uuid\v1;


class GetController extends Controller
{
    public function get(request $request) {
        $data = [
            'inflic' => $request->inflics,
            'personnel' => $request->personnels,
        ];

       // return($massive[0][0]);
        $calc = new calculate();
        $calc->user_id = Auth::id();
        $calc->save();

        $this->createinflics($data['inflic'], $calc->id);
        $this->createpersonnels($data['personnel'], $calc->id);


        return("I saved all");
    }

    public function createinflics($data, $calculateid) {
        //dd($calculateid);
        //dd($data);
        $data1 = $data['infra'];

        if ($data1['type'] == "CAPEX") {
            inflic::updateOrCreate(
                [
                    'item' => 'Стоимость инфраструктуры',
                    'type' => 'CAPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры',
                ],
                [
                    'calculate_id' => $calculateid,
                    'inflic_1_year' => $data1['object1']['1year'],
                    'inflic_2_year' => $data1['object1']['2year'],
                    'inflic_3_year' => $data1['object1']['3year'],
                    'inflic_4_year' => $data1['object1']['4year'],
                    'inflic_5_year' => $data1['object1']['5year'],
                ]
            );
            inflic::updateOrCreate(
                [
                    'item' => 'Стоимость инфраструктуры (облачная)',
                    'type' => 'OPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры (облачной)',
                ],
                [
                    'calculate_id' => $calculateid,
                    'inflic_1_year' => null,
                    'inflic_2_year' => null,
                    'inflic_3_year' => null,
                    'inflic_4_year' => null,
                    'inflic_5_year' => null,
                ]
            );
        }
        else {
            inflic::updateOrCreate(
                [
                    'item' => 'Стоимость инфраструктуры',
                    'type' => 'CAPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры',
                ],
                [
                    'calculate_id' => $calculateid,
                    'inflic_1_year' => null,
                    'inflic_2_year' => null,
                    'inflic_3_year' => null,
                    'inflic_4_year' => null,
                    'inflic_5_year' => null,
                ]
            );
            inflic::updateOrCreate(
                [
                    'item' => 'Стоимость инфраструктуры (облачная)',
                    'type' => 'OPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры (облачной)',
                ],
                [
                    'calculate_id' => $calculateid,
                    'inflic_1_year' => $data1['object1']['1year'],
                    'inflic_2_year' => $data1['object1']['2year'],
                    'inflic_3_year' => $data1['object1']['3year'],
                    'inflic_4_year' => $data1['object1']['4year'],
                    'inflic_5_year' => $data1['object1']['5year'],
                ]
            );
        }
        inflic::updateOrCreate(
            [
                'item' => 'Сопровождение инфраструктуры',
                'type' => 'CAPEX',
                'description' => 'Укажите общую стоимость сопровождения инфраструктуры (техническая поддержка инфраструктурного ПО и ФОТ обслуживающего персонала)',
            ],
            [
                'calculate_id' => $calculateid,
                'inflic_1_year' => $data1['object2']['1year'],
                'inflic_2_year' => $data1['object2']['2year'],
                'inflic_3_year' => $data1['object2']['3year'],
                'inflic_4_year' => $data1['object2']['4year'],
                'inflic_5_year' => $data1['object2']['5year'],
            ]
        );
        inflic::updateOrCreate(
            [
                'item' => 'Переферийное оборудование',
                'type' => 'OPEX',
                'description' => 'Укажите общую стоимость используемого переферийного оборудования в ИС',
            ],
            [
                'calculate_id' => $calculateid,
                'inflic_1_year' => $data1['object3']['1year'],
                'inflic_2_year' => $data1['object3']['2year'],
                'inflic_3_year' => $data1['object3']['3year'],
                'inflic_4_year' => $data1['object3']['4year'],
                'inflic_5_year' => $data1['object3']['5year'],
            ]
        );


        //dd($calculateid);

        $data1 = $data['licen'];
        inflic::updateOrCreate(
            [
                'item' => 'Стоимость лицензий/программного обеспечения',
                'type' => 'CAPEX',
                'description' => 'Укажите общую стоимость лицензий/программного обеспечения самой информационной системы. Затраты берутся из контракта на программное обеспечение'
            ],
            [
                'calculate_id' => $calculateid,
                'inflic_1_year' => $data1['object1']['1year'],
                'inflic_2_year' => $data1['object1']['2year'],
                'inflic_3_year' => $data1['object1']['3year'],
                'inflic_4_year' => $data1['object1']['4year'],
                'inflic_5_year' => $data1['object1']['5year'],
            ]
        );
        inflic::updateOrCreate(
            [
                'item' => 'Стоимость технической поддержки информационной системы',
                'type' => 'OPEX',
                'description' => 'Укажите стоимость технической поддержки информационной системы. Затраты берутся из контракта на программное обеспечение'
            ],
            [
                'calculate_id' => $calculateid,
                'inflic_1_year' => $data1['object2']['1year'],
                'inflic_2_year' => $data1['object2']['2year'],
                'inflic_3_year' => $data1['object2']['3year'],
                'inflic_4_year' => $data1['object2']['4year'],
                'inflic_5_year' => $data1['object2']['5year'],
            ]
        );
        inflic::updateOrCreate(
            [
                'item' => 'Аутсорс информационной системы',
                'type' => 'OPEX',
                'description' => 'Укажите стоимость аутсорса информационной системы. Затраты берутся из контракта на аутсорс'
            ],
            [
                'calculate_id' => $calculateid,
                'inflic_1_year' => $data1['object3']['1year'],
                'inflic_2_year' => $data1['object3']['2year'],
                'inflic_3_year' => $data1['object3']['3year'],
                'inflic_4_year' => $data1['object3']['4year'],
                'inflic_5_year' => $data1['object3']['5year'],
            ]
        );

        // Предыдущий вариант сохранения:
        // dd($data1['object1']['1year']);
        // dd($data1);
        /* if ($data1['type'] == "CAPEX") {
             $infr = inflic::find(1);
         }
         else {
             $infr = inflic::find(2);
         }
         unset($data1['type']);*/


        /*$j=2;
        foreach($data1 as $object) {
            $infr->calculate_id = $calculateid;
            $infr->inflic_1_year = $object['1year'];
            $infr->inflic_2_year = $object['2year'];
            $infr->inflic_3_year = $object['3year'];
            $infr->inflic_4_year = $object['4year'];
            $infr->inflic_5_year = $object['5year'];
            $infr->save();
            if ($j < 4) {
                $j++;
                $infr = inflic::find($j);
            }

        }*/
       /*
        $j=5;
        foreach($data1 as $object) {
            $lics = inflic::find($j);
            $lics->calculate_id = $calculateid;
            $lics->inflic_1_year = $object['1year'];
            $lics->inflic_2_year = $object['2year'];
            $lics->inflic_3_year = $object['3year'];
            $lics->inflic_4_year = $object['4year'];
            $lics->inflic_5_year = $object['5year'];
            $lics->save();
            if ($j < 7) $j++;
        }*/
    }
    public function createpersonnels($employees, $calculateid) {
        //dd($employees);
        foreach($employees as $employee) {
            $worker = new personnel();
            $worker->calculate_id = $calculateid;
            $worker->post = $employee['post'];
            $worker->quantity_of_the_rate = $employee['quantity_of_the_rate'];
            $worker->unified_social_tax = $employee['unified_social_tax'];
            $worker->wage = $employee['wage'];
            $worker->number_of_month_of_work = $employee['number_of_month_of_work'];
            $worker->save();
        }
    }
}
