<?php

namespace App\Http\Controllers;

use App\Models\calculate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalcController extends Controller
{
    /*public function calculate(Request $request){
       // dd($request->all());
        // TODO validation
        // Model save

        //calculate

        return response()->json(['success'=>true]);
    }*/
    public function example()
    {
        //$exxx = new calculate;
        //$exxx->save();
        for($i = 1; $i<7; $i++) {
            $exxx = calculate::find($i);
            $some = $exxx->inflics;

            foreach ($some as $som) {
                $summ = 0;
                $exxx->item = $som->item;
                $exxx->type = $som->type;
                $exxx->description = $som->description;
                $exxx->inflic_1_year = $som->inflic_1_year;
                $exxx->inflic_2_year = $som->inflic_2_year;
                $exxx->inflic_3_year = $som->inflic_3_year;
                $exxx->inflic_4_year = $som->inflic_4_year;
                $exxx->inflic_5_year = $som->inflic_5_year;
                $summ = $som->inflic_1_year;
                $summ = $summ + $som->inflic_2_year;
                $summ = $summ + $som->inflic_3_year;
                $summ = $summ + $som->inflic_4_year;
                $summ = $summ + $som->inflic_5_year;
                $exxx->total = $summ;
            }
            $exxx->save();
        }
        return("MMM");
    }
}
