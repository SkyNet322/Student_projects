<?php

namespace App\Http\Controllers;

use App\Models\Calculate;
use App\Models\DataSpecial;
use App\Models\Connect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\lessThanOrEqual;
use App\Models\inflic;
use Illuminate\Support\Facades\Auth;

use App\Exports\CalculateExport;
use Maatwebsite\Excel\Facades\Excel;

class UseDataController extends Controller
{
    /**
     * @param Request $request
     * @return array|string
     */
    public function useguid(request $request): array|string
    {

        $guid = null;

        $data = [
            'nameIS' => $request->nameIS,
            'GUID' => $request->GUID
        ];

        if ($data['GUID']) {
            $guid = (new DataSpecial)->where('GUID', '=', $data['GUID'])->first();
        }
        if ($data['nameIS']) {
            $guid = (new DataSpecial)->where('name', '=', $data['nameIS'])->first();
        }

        if ($guid) {
            if ($guid->connects && $guid->connects->user_id == Auth::user()->id) {
                return [
                    'calculated' => 'true',
                    'id' => $guid->id
                ];
            } else {
                return [
                    'calculated' => 'false',
                    'id' => $guid->id
                ];
            }
        } else {
            $returnData = array(
                'status' => 'error',
                'message' => 'Неправильный номер Guid/Неправильное название ИС'
            );
            return response()->json($returnData, 200);
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function sendguid(): \Illuminate\Database\Eloquent\Collection
    {
        return (DataSpecial::all());
    }

}
