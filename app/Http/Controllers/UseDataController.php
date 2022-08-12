<?php

namespace App\Http\Controllers;

use App\Models\DataSpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\lessThanOrEqual;
use App\Models\inflic;

class UseDataController extends Controller
{
    public function useguid(request $request)
    {
        $data = [
            'nameIS' => $request->nameIS,
            'GUID' => $request->GUID
        ];
        if ($data['GUID'])
        {
            $guid = (new DataSpecial)->where('GUID', '=', $data['GUID'])->first();
            if($guid) {
                return("TRUE");
            }
            else {
                return ("something wrong");
            }
        }
        else
        {
            if ($data['nameIS']) {
                $guid = (new DataSpecial)->where('name', '=', $data['nameIS'])->first();
                if ($guid) {
                    return("TRUE");
                } else {
                    return ("something wrong");
                }
            }
            else return("something wrong");
        }
    }

    public function sendguid() {
        return(DataSpecial::all());
    }
    /* Устарело: public function sendinfra()
    {

        $massive = [];
        for($i=1; $i<5; $i++)
        {
            $infr = inflic::find($i);
            array_push($massive, [
                'item' => $infr->item,
                'type' => $infr->type,
                'description' => $infr->description,
            ]);
        }

        return($massive);
    }*/

   /* Устарело: public function sendlicen()
    {

        $massive = [];
        for($i=5; $i<8; $i++)
        {
            $licen = inflic::find($i);
            array_push($massive, [
                'item' => $licen->item,
                'type' => $licen->type,
                'description' => $licen->description,
            ]);
        }

        return($massive);
    }*/


}
