<?php

namespace App\Http\Controllers;

use App\Models\DataSpecial;
use App\Models\Inflic;
use App\Models\Connect;
use App\Models\Personnel;
use App\Models\calculate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Illuminate\Support\Facades\Auth;
use function Ramsey\Uuid\v1;


class GetController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function store(request $request): string
    {
        $data = [
            'inflic' => $request->inflics,
            'personnel' => $request->personnels,
            'guid_id' => $request->guid_id,
        ];

        $connect = Connect::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'guid_id' => $data['guid_id'],
            ],
            [
                'guid_id' => $data['guid_id'],
            ]
        );

        if (!$connect) {
            return ('You are very megastuid');
        }

        $this->createInflics($data['inflic'], $connect->id);
        $this->createPersonnels($data['personnel'], $connect->id);

        return ("I saved all");
    }

    /**
     * @param $data
     * @param $calculateid
     * @return void
     */
    public function createInflics($data, $calculateid)
    {
        $data1 = $data['infra'];

        if ($data1['type'] == "CAPEX") {
            Inflic::updateOrCreate(
                [
                    'connect_id' => $calculateid,
                    'item' => 'Стоимость инфраструктуры',
                    'type' => 'CAPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры',
                ],
                [
                    //'calculate_id' => $calculateid,
                    'inflic_1_year' => $data1['object1']['1year'],
                    'inflic_2_year' => $data1['object1']['2year'],
                    'inflic_3_year' => $data1['object1']['3year'],
                    'inflic_4_year' => $data1['object1']['4year'],
                    'inflic_5_year' => $data1['object1']['5year'],
                ]
            );
            Inflic::updateOrCreate(
                [
                    'connect_id' => $calculateid,
                    'item' => 'Стоимость инфраструктуры (облачная)',
                    'type' => 'OPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры (облачной)',
                ],
                [
                    'inflic_1_year' => null,
                    'inflic_2_year' => null,
                    'inflic_3_year' => null,
                    'inflic_4_year' => null,
                    'inflic_5_year' => null,
                ]
            );
        } else {
            Inflic::updateOrCreate(
                [
                    'connect_id' => $calculateid,
                    'item' => 'Стоимость инфраструктуры',
                    'type' => 'CAPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры',
                ],
                [
                    'inflic_1_year' => null,
                    'inflic_2_year' => null,
                    'inflic_3_year' => null,
                    'inflic_4_year' => null,
                    'inflic_5_year' => null,
                ]
            );
            Inflic::updateOrCreate(
                [
                    'connect_id' => $calculateid,
                    'item' => 'Стоимость инфраструктуры (облачная)',
                    'type' => 'OPEX',
                    'description' => 'Укажите общую стоимость инфраструктуры (облачной)',
                ],
                [
                    'inflic_1_year' => $data1['object1']['1year'],
                    'inflic_2_year' => $data1['object1']['2year'],
                    'inflic_3_year' => $data1['object1']['3year'],
                    'inflic_4_year' => $data1['object1']['4year'],
                    'inflic_5_year' => $data1['object1']['5year'],
                ]
            );
        }
        Inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Сопровождение инфраструктуры',
                'type' => 'CAPEX',
                'description' => 'Укажите общую стоимость сопровождения инфраструктуры (техническая поддержка инфраструктурного ПО и ФОТ обслуживающего персонала)',
            ],
            [
                'inflic_1_year' => $data1['object2']['1year'],
                'inflic_2_year' => $data1['object2']['2year'],
                'inflic_3_year' => $data1['object2']['3year'],
                'inflic_4_year' => $data1['object2']['4year'],
                'inflic_5_year' => $data1['object2']['5year'],
            ]
        );
        Inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Переферийное оборудование',
                'type' => 'OPEX',
                'description' => 'Укажите общую стоимость используемого переферийного оборудования в ИС',
            ],
            [
                'inflic_1_year' => $data1['object3']['1year'],
                'inflic_2_year' => $data1['object3']['2year'],
                'inflic_3_year' => $data1['object3']['3year'],
                'inflic_4_year' => $data1['object3']['4year'],
                'inflic_5_year' => $data1['object3']['5year'],
            ]
        );

        $data1 = $data['licen'];
        Inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Стоимость лицензий/программного обеспечения',
                'type' => 'CAPEX',
                'description' => 'Укажите общую стоимость лицензий/программного обеспечения самой информационной системы. Затраты берутся из контракта на программное обеспечение',
            ],
            [
                'inflic_1_year' => $data1['object1']['1year'],
                'inflic_2_year' => $data1['object1']['2year'],
                'inflic_3_year' => $data1['object1']['3year'],
                'inflic_4_year' => $data1['object1']['4year'],
                'inflic_5_year' => $data1['object1']['5year'],
            ]
        );
        Inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Стоимость технической поддержки информационной системы',
                'type' => 'OPEX',
                'description' => 'Укажите стоимость технической поддержки информационной системы. Затраты берутся из контракта на программное обеспечение',
            ],
            [
                'inflic_1_year' => $data1['object2']['1year'],
                'inflic_2_year' => $data1['object2']['2year'],
                'inflic_3_year' => $data1['object2']['3year'],
                'inflic_4_year' => $data1['object2']['4year'],
                'inflic_5_year' => $data1['object2']['5year'],
            ]
        );
        Inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Аутсорс информационной системы',
                'type' => 'OPEX',
                'description' => 'Укажите стоимость аутсорса информационной системы. Затраты берутся из контракта на аутсорс',
            ],
            [
                'inflic_1_year' => $data1['object3']['1year'],
                'inflic_2_year' => $data1['object3']['2year'],
                'inflic_3_year' => $data1['object3']['3year'],
                'inflic_4_year' => $data1['object3']['4year'],
                'inflic_5_year' => $data1['object3']['5year'],
            ]
        );
    }

    /**
     * @param $data
     * @param $calculateid
     * @return void
     */
    public function createPersonnels($data, $calculateid)
    {
        $deleteexistngpersonnel = Personnel::where('connect_id', '=', $calculateid)->delete();

        $employees = $data['development'];
        foreach ($employees as $employee) {
            $worker = new Personnel();
            $worker->team = 'development';
            $worker->connect_id = $calculateid;
            $worker->post = $employee['post'];
            $worker->quantity_of_the_rate = $employee['quantity_of_the_rate'];
            $worker->unified_social_tax = $employee['unified_social_tax'];
            $worker->wage = $employee['wage'];
            $worker->number_of_month_of_work = $employee['number_of_month_of_work'];
            $worker->save();
        }
        $employees = $data['support'];
        foreach ($employees as $employee) {
            $worker = new Personnel();
            $worker->team = 'support';
            $worker->connect_id = $calculateid;
            $worker->post = $employee['post'];
            $worker->quantity_of_the_rate = $employee['quantity_of_the_rate'];
            $worker->unified_social_tax = $employee['unified_social_tax'];
            $worker->wage = $employee['wage'];
            $worker->number_of_month_of_work = $employee['number_of_month_of_work'];
            $worker->save();
        }
    }
}
