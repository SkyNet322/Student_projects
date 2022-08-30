<?php

namespace App\Http\Controllers;

use App\Exports\CalculateExport;
use App\Models\Calculate;
use App\Models\Connect;
use App\Models\Personnel;
use App\Models\inflic;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class CalcController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function calculate(request $request): array|string
    {
        $guidId = $request->guid_id;

        $connect = Connect::where( [
            ['user_id', '=', Auth::id()],
            ['guid_id', '=', $guidId]
            ] )->first();

        if (!$connect) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Отсутствуют данные для расчёта'
            );
            return response()->json($returnData, 200);
        }

        $bigData = (new Calculate())->getCalculate($connect);

        return($bigData);
    }

    /**
     * @param Request $request
     * NO return \Maatwebsite\Excel\Facades\Excel ????
     */
    public function export(request $request)    //: Maatwebsite\Excel\Facades\Excel //????
    {
        $guidId = $request->guid_id;

        $connect = Connect::where( [
            ['user_id', '=', Auth::id()],
            ['guid_id', '=', $guidId]
        ] )->first();

        if (!$connect) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Отсутствуют данные для расчёта'
            );
            return response()->json($returnData, 200);
        }

        $file_path = 'file_of_calculates.xlsx';
        $disk = 'public-test';
        Excel::store(new CalculateExport($connect), $file_path, $disk);
        $exists = Storage::disk($disk)->exists($file_path);

        if(!$exists) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Не существует указанного файла'
            );
            return response()->json($returnData, 200);
        }

        $file = Storage::disk($disk)->path($file_path);

        return $file;
    }
}
