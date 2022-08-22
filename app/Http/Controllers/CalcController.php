<?php

namespace App\Http\Controllers;

use App\Models\Calculate;
use App\Models\Connect;
use App\Models\personnel;
use App\Models\inflic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalcController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function calculate(request $request): array
    {
        $guidId = $request->guid_id;

        $connect = Connect::where( [
            ['user_id', '=', Auth::id()],
            ['guid_id', '=', $guidId]
            ] )->first();

        $bigData = (new Calculate())->getCalculate($connect);

        return($bigData);
    }
}
