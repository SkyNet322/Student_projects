<?php

namespace App\Http\Controllers;

use App\Models\inflic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;

class GetController extends Controller
{
    public function getinfralicen(request $request) {
        $massive = [
            [
                $request->type,
                $request->value1,
                $request->value2,
                $request->value3,
                $request->value4,
                $request->value5,
                $request->value6,
                $request->value7,
                $request->value8,
                $request->value9,
                $request->value10,
                $request->value11,
                $request->value12,
                $request->value13,
                $request->value14,
                $request->value15
            ],
            [
                $request->value16,
                $request->value17,
                $request->value18,
                $request->value19,
                $request->value20,
                $request->value21,
                $request->value22,
                $request->value23,
                $request->value24,
                $request->value25,
                $request->value26,
                $request->value27,
                $request->value28,
                $request->value29,
                $request->value30
            ],
        ];
       // return($massive[0][0]);


        $type = $massive[0][0];
        if ($type == "CAPEX") {
            $infr = inflic::find(1);
        }
        else {
            $infr = inflic::find(2);
        }
        $infr->calculate_id = 1;
        $infr->inflic_1_year = $massive[0][1];
        $infr->inflic_2_year = $massive[0][2];
        $infr->inflic_3_year = $massive[0][3];
        $infr->inflic_4_year = $massive[0][4];
        $infr->inflic_5_year = $massive[0][5];
        $infr->save();
        $infr = inflic::find(3);
        $infr->calculate_id = 2;
        $infr->inflic_1_year = $massive[0][6];
        $infr->inflic_2_year = $massive[0][7];
        $infr->inflic_3_year = $massive[0][8];
        $infr->inflic_4_year = $massive[0][9];
        $infr->inflic_5_year = $massive[0][10];
        $infr->save();
        $infr = inflic::find(4);
        $infr->calculate_id = 3;
        $infr->inflic_1_year = $massive[0][11];
        $infr->inflic_2_year = $massive[0][12];
        $infr->inflic_3_year = $massive[0][13];
        $infr->inflic_4_year = $massive[0][14];
        $infr->inflic_5_year = $massive[0][15];
        $infr->save();
        $lics = inflic::find(5);
        $lics->calculate_id = 4;
        $lics->inflic_1_year = $massive[1][0];
        $lics->inflic_2_year = $massive[1][1];
        $lics->inflic_3_year = $massive[1][2];
        $lics->inflic_4_year = $massive[1][3];
        $lics->inflic_5_year = $massive[1][4];
        $lics->save();
        $lics = inflic::find(6);
        $lics->calculate_id = 5;
        $lics->inflic_1_year = $massive[1][5];
        $lics->inflic_2_year = $massive[1][6];
        $lics->inflic_3_year = $massive[1][7];
        $lics->inflic_4_year = $massive[1][8];
        $lics->inflic_5_year = $massive[1][9];
        $lics->save();
        $lics = inflic::find(7);
        $lics->calculate_id = 6;
        $lics->inflic_1_year = $massive[1][10];
        $lics->inflic_2_year = $massive[1][11];
        $lics->inflic_3_year = $massive[1][12];
        $lics->inflic_4_year = $massive[1][13];
        $lics->inflic_5_year = $massive[1][14];
        $lics->save();
        return($lics);
    }
}
