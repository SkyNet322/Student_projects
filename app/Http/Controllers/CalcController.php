<?php

namespace App\Http\Controllers;

use App\Models\calculate;
use App\Models\inflic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalcController extends Controller
{
    public function calculate(){
       // dd($request->all());
        // TODO validation
        // Model save

        //calculate
        $massive = [];
        $data = inflic::all();
        foreach($data as $dat) {
            array_push($massive,
            [
                '1year' => $dat['inflic_1_year'],
                '2year' => $dat['inflic_2_year'],
                '3year' => $dat['inflic_3_year'],
                '4year' => $dat['inflic_4_year'],
                '5year' => $dat['inflic_5_year'],
                'total' => $dat['inflic_1_year']+$dat['inflic_2_year']+$dat['inflic_3_year']+$dat['inflic_4_year']+$dat['inflic_5_year'],
            ]);
        }
        return($massive);
        //return response()->json(['success'=>true]);
    }

}
