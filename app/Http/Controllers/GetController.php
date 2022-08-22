<?php

namespace App\Http\Controllers;

use App\Models\DataSpecial;
use App\Models\inflic;
use App\Models\connect;
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
            'guidid' => $request->guidid,
        ];

       // return($massive[0][0]);
       /* $calc = new calculate();
        $calc->user_id = Auth::id();
        $calc->save();*/




        //dd(Auth::id());
        $ggg = connect::where( [
            ['user_id', '=', Auth::id()],
            ['guid_id', '=', $data['guidid']]
            ] )->first();
        //$ggg = connect::where('guid_id', '=', $data['guidid'])->where('user_id', '=', Auth::id())->get();
        //dd($ggg);
        if(!$ggg) { return('You are very megastuid'); }




        $this->createinflics($data['inflic'], $ggg->id);
        $this->createpersonnels($data['personnel'], $ggg->id);


        return("I saved all");
    }

    public function createinflics($data, $calculateid) {
        //dd($calculateid);
        //dd($data);
        $data1 = $data['infra'];

        if ($data1['type'] == "CAPEX") {
             inflic::updateOrCreate(
                 [
                     'connect_id' => $calculateid,
                 ],
                 [
                     //'calculate_id' => $calculateid,
                     'item' => 'Стоимость инфраструктуры',
                     'type' => 'CAPEX',
                     'description' => 'Укажите общую стоимость инфраструктуры',
                     'inflic_1_year' => $data1['object1']['1year'],
                     'inflic_2_year' => $data1['object1']['2year'],
                     'inflic_3_year' => $data1['object1']['3year'],
                     'inflic_4_year' => $data1['object1']['4year'],
                     'inflic_5_year' => $data1['object1']['5year'],
                 ]
             );
             inflic::updateOrCreate(
                 [
                     'connect_id' => $calculateid,
                     'item' => 'Стоимость инфраструктуры (облачная)',
                     'type' => 'OPEX',
                     'description' => 'Укажите общую стоимость инфраструктуры (облачной)',
                 ],
                 [
                     //'calculate_id' => $calculateid,

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
                     'connect_id' => $calculateid,
                     'item' => 'Стоимость инфраструктуры',
                     'type' => 'CAPEX',
                     'description' => 'Укажите общую стоимость инфраструктуры',
                 ],
                 [
                     //'calculate_id' => $calculateid,

                     'inflic_1_year' => null,
                     'inflic_2_year' => null,
                     'inflic_3_year' => null,
                     'inflic_4_year' => null,
                     'inflic_5_year' => null,
                 ]
             );
             inflic::updateOrCreate(
                 [
                     'connect_id' => $calculateid,
                     'item' => 'Стоимость инфраструктуры (облачная)',
                     'type' => 'OPEX',
                     'description' => 'Укажите общую стоимость инфраструктуры (облачной)',
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
         }
        inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Сопровождение инфраструктуры',
                'type' => 'CAPEX',
                'description' => 'Укажите общую стоимость сопровождения инфраструктуры (техническая поддержка инфраструктурного ПО и ФОТ обслуживающего персонала)',
            ],
            [
                //'calculate_id' => $calculateid,

                'inflic_1_year' => $data1['object2']['1year'],
                'inflic_2_year' => $data1['object2']['2year'],
                'inflic_3_year' => $data1['object2']['3year'],
                'inflic_4_year' => $data1['object2']['4year'],
                'inflic_5_year' => $data1['object2']['5year'],
            ]
        );
        inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Переферийное оборудование',
                'type' => 'OPEX',
                'description' => 'Укажите общую стоимость используемого переферийного оборудования в ИС',
            ],
            [
                //'calculate_id' => $calculateid,

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
                'connect_id' => $calculateid,
                'item' => 'Переферийное оборудование',
                'type' => 'OPEX',
                'description' => 'Укажите общую стоимость используемого переферийного оборудования в ИС',
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
        inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Стоимость технической поддержки информационной системы',
                'type' => 'OPEX',
                'description' => 'Укажите стоимость технической поддержки информационной системы. Затраты берутся из контракта на программное обеспечение',
            ],
            [
                //'calculate_id' => $calculateid,

                'inflic_1_year' => $data1['object2']['1year'],
                'inflic_2_year' => $data1['object2']['2year'],
                'inflic_3_year' => $data1['object2']['3year'],
                'inflic_4_year' => $data1['object2']['4year'],
                'inflic_5_year' => $data1['object2']['5year'],
            ]
        );
       inflic::updateOrCreate(
            [
                'connect_id' => $calculateid,
                'item' => 'Аутсорс информационной системы',
                'type' => 'OPEX',
                'description' => 'Укажите стоимость аутсорса информационной системы. Затраты берутся из контракта на аутсорс',
            ],
            [
                //'calculate_id' => $calculateid,

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
        /*
        if ($data1['type'] == "CAPEX") {

            $infr = new inflic;
            $infr->item = 'Стоимость инфраструктуры';
            $infr->type = 'CAPEX';
            $infr->description = 'Укажите общую стоимость инфраструктуры';
            $infr->guid_id = $calculateid;
            $infr->inflic_1_year = $data1['object1']['1year'];
            $infr->inflic_2_year = $data1['object1']['2year'];
            $infr->inflic_3_year = $data1['object1']['3year'];
            $infr->inflic_4_year = $data1['object1']['4year'];
            $infr->inflic_5_year = $data1['object1']['5year'];
            $infr->save();

            $infr = new inflic;
            $infr->item = 'Стоимость инфраструктуры (облачная)';
            $infr->type = 'OPEX';
            $infr->description = 'Укажите общую стоимость инфраструктуры (облачной)';
            $infr->guid_id = $calculateid;
            $infr->inflic_1_year = null;
            $infr->inflic_2_year = null;
            $infr->inflic_3_year = null;
            $infr->inflic_4_year = null;
            $infr->inflic_5_year = null;
            $infr->save();

        }
        else {
            $infr = new inflic;
            $infr->item = 'Стоимость инфраструктуры';
            $infr->type = 'CAPEX';
            $infr->description = 'Укажите общую стоимость инфраструктуры';
            $infr->guid_id = $calculateid;
            $infr->inflic_1_year = null;
            $infr->inflic_2_year = null;
            $infr->inflic_3_year = null;
            $infr->inflic_4_year = null;
            $infr->inflic_5_year = null;
            $infr->save();

            $infr = new inflic;
            $infr->item = 'Стоимость инфраструктуры (облачная)';
            $infr->type = 'OPEX';
            $infr->description = 'Укажите общую стоимость инфраструктуры (облачной)';
            $infr->guid_id = $calculateid;
            $infr->inflic_1_year = $data1['object1']['1year'];
            $infr->inflic_2_year = $data1['object1']['2year'];
            $infr->inflic_3_year = $data1['object1']['3year'];
            $infr->inflic_4_year = $data1['object1']['4year'];
            $infr->inflic_5_year = $data1['object1']['5year'];
            $infr->save();

        }

        $infr = new inflic;
        $infr->item = 'Сопровождение инфраструктуры';
        $infr->type = 'CAPEX';
        $infr->description = 'Укажите общую стоимость сопровождения инфраструктуры (техническая поддержка инфраструктурного ПО и ФОТ обслуживающего персонала)';
        $infr->guid_id = $calculateid;
        $infr->inflic_1_year = $data1['object2']['1year'];
        $infr->inflic_2_year = $data1['object2']['2year'];
        $infr->inflic_3_year = $data1['object2']['3year'];
        $infr->inflic_4_year = $data1['object2']['4year'];
        $infr->inflic_5_year = $data1['object2']['5year'];
        $infr->save();

        $infr = new inflic;
        $infr->item = 'Переферийное оборудование';
        $infr->type = 'OPEX';
        $infr->description = 'Укажите общую стоимость используемого переферийного оборудования в ИС';
        $infr->guid_id = $calculateid;
        $infr->inflic_1_year = $data1['object3']['1year'];
        $infr->inflic_2_year = $data1['object3']['2year'];
        $infr->inflic_3_year = $data1['object3']['3year'];
        $infr->inflic_4_year = $data1['object3']['4year'];
        $infr->inflic_5_year = $data1['object3']['5year'];
        $infr->save();

        $data1 = $data['licen'];

        $infr = new inflic;
        $infr->item = 'Стоимость лицензий/программного обеспечения';
        $infr->type = 'CAPEX';
        $infr->description = 'Укажите общую стоимость лицензий/программного обеспечения самой информационной системы. Затраты берутся из контракта на программное обеспечение';
        $infr->guid_id = $calculateid;
        $infr->inflic_1_year = $data1['object1']['1year'];
        $infr->inflic_2_year = $data1['object1']['2year'];
        $infr->inflic_3_year = $data1['object1']['3year'];
        $infr->inflic_4_year = $data1['object1']['4year'];
        $infr->inflic_5_year = $data1['object1']['5year'];
        $infr->save();

        $infr = new inflic;
        $infr->item = 'Стоимость технической поддержки информационной системы';
        $infr->type = 'OPEX';
        $infr->description = 'Укажите стоимость технической поддержки информационной системы. Затраты берутся из контракта на программное обеспечение';
        $infr->guid_id = $calculateid;
        $infr->inflic_1_year = $data1['object2']['1year'];
        $infr->inflic_2_year = $data1['object2']['2year'];
        $infr->inflic_3_year = $data1['object2']['3year'];
        $infr->inflic_4_year = $data1['object2']['4year'];
        $infr->inflic_5_year = $data1['object2']['5year'];
        $infr->save();

        $infr = new inflic;
        $infr->item = 'Аутсорс информационной системы';
        $infr->type = 'OPEX';
        $infr->description = 'Укажите стоимость аутсорса информационной системы. Затраты берутся из контракта на аутсорс';
        $infr->guid_id = $calculateid;
        $infr->inflic_1_year = $data1['object3']['1year'];
        $infr->inflic_2_year = $data1['object3']['2year'];
        $infr->inflic_3_year = $data1['object3']['3year'];
        $infr->inflic_4_year = $data1['object3']['4year'];
        $infr->inflic_5_year = $data1['object3']['5year'];
        $infr->save();



        if ($data1['type'] == "CAPEX") {
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
    public function createpersonnels($data, $calculateid) {
        //dd($data);
        $deleteexistngpersonnel = personnel::where('connect_id', '=', $calculateid)->delete();

        $employees = $data['development'];
        foreach($employees as $employee) {
            $worker = new personnel();
            $worker->team = 'development';
            //$worker->calculate_id = $calculateid;
            $worker->connect_id = $calculateid;
            $worker->post = $employee['post'];
            $worker->quantity_of_the_rate = $employee['quantity_of_the_rate'];
            $worker->unified_social_tax = $employee['unified_social_tax'];
            $worker->wage = $employee['wage'];
            $worker->number_of_month_of_work = $employee['number_of_month_of_work'];
            $worker->save();
        }
        $employees = $data['support'];
        foreach($employees as $employee) {
            $worker = new personnel();
            $worker->team = 'support';
           // $worker->calculate_id = $calculateid;
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
