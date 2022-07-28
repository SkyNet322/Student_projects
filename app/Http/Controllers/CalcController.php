<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function calculate(Request $request){
       // dd($request->all());
        // TODO validation
        // Model save

        //calculate

        return response()->json(['success'=>true]);
    }
}
