<?php

namespace App\Http\Controllers;

use App\Models\DataSpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\lessThanOrEqual;

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
                return($guid);
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
                    return($guid);
                } else {
                    return ("something wrong");
                }
            }
            else return("something wrong");
        }
    }
}
