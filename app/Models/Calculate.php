<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * @param $connect
     * @return array
     */
    public function getCalculate($connect): array
    {
        $tsoCAPEX = [
            '1year' => 0,
            '2year' => 0,
            '3year' => 0,
            '4year' => 0,
            '5year' => 0,
        ];

        $tsoOPEX = [
            '1year' => 0,
            '2year' => 0,
            '3year' => 0,
            '4year' => 0,
            '5year' => 0,
        ];

        $massive = [];

        $data = Inflic::orderBy('id')->where('connect_id', '=', $connect->id)->get();

        foreach($data as $dat) {
            array_push($massive,
                [
                    'item' => $dat['item'],
                    'type' => $dat['type'],
                    '1year' => $dat['inflic_1_year'],
                    '2year' => $dat['inflic_2_year'],
                    '3year' => $dat['inflic_3_year'],
                    '4year' => $dat['inflic_4_year'],
                    '5year' => $dat['inflic_5_year'],
                    'total' => $dat['inflic_1_year']+$dat['inflic_2_year']+$dat['inflic_3_year']+$dat['inflic_4_year']+$dat['inflic_5_year'],
                ]);

            if ($dat->type == 'CAPEX') {
                $tsoCAPEX['1year'] += $dat['inflic_1_year'];
                $tsoCAPEX['2year'] += $dat['inflic_2_year'];
                $tsoCAPEX['3year'] += $dat['inflic_3_year'];
                $tsoCAPEX['4year'] += $dat['inflic_4_year'];
                $tsoCAPEX['5year'] += $dat['inflic_5_year'];
            }
            else {
                if ($dat->type == 'OPEX') {
                    $tsoOPEX['1year'] += $dat['inflic_1_year'];
                    $tsoOPEX['2year'] += $dat['inflic_2_year'];
                    $tsoOPEX['3year'] += $dat['inflic_3_year'];
                    $tsoOPEX['4year'] += $dat['inflic_4_year'];
                    $tsoOPEX['5year'] += $dat['inflic_5_year'];
                }
            }
        }

        $tsoCAPEX['total'] = $tsoCAPEX['1year'] + $tsoCAPEX['2year'] + $tsoCAPEX['3year'] + $tsoCAPEX['4year'] + $tsoCAPEX['5year'];
        $tsoOPEX['total'] = $tsoOPEX['1year'] + $tsoOPEX['2year'] + $tsoOPEX['3year'] + $tsoOPEX['4year'] + $tsoOPEX['5year'];

        $bigData = [];

        $bigData['tsoCAPEX'] = $tsoCAPEX;
        $bigData['tsoOPEX'] = $tsoOPEX;
        $bigData['inflic'] = $massive;

        $massive = [];

        $team = Personnel::where([
            ['team', '=', 'development'],
            ['connect_id', '=', $connect->id]
        ])->get();

        $massive = [
            '1year' => 0,
            '2year' => 0,
            '3year' => 0,
            '4year' => 0,
            '5year' => 0,
        ];

        foreach ($team as $worker) {
            $this->fill_massive($massive, $worker->number_of_month_of_work, $this->month($worker));
        }

        $massive['total'] = $massive['1year'] + $massive['2year'] + $massive['3year'] + $massive['4year'] + $massive['5year'];
        $bigData['development'] = $massive;

        $massive = [];

        $team = Personnel::where([
            ['team', '=', 'support'],
            ['connect_id', '=', $connect->id]
        ])->get();

        $massive = [
            '1year' => 0,
            '2year' => 0,
            '3year' => 0,
            '4year' => 0,
            '5year' => 0,
        ];

        foreach ($team as $worker) {
            $this->fill_massive($massive, $worker->number_of_month_of_work, $this->month($worker));
        }

        $massive['total'] = $massive['1year'] + $massive['2year'] + $massive['3year'] + $massive['4year'] + $massive['5year'];
        $bigData['support'] = $massive;

        return $bigData;
    }

    /**
     * @param $worker
     * @return float|int
     */
    public function month($worker): float|int
    {
        $procent = preg_replace('/[^0-9]/', '', $worker->unified_social_tax);
        $zp = ($worker->wage + ($worker->wage * ($procent / 100) ) ) * ($worker->quantity_of_the_rate);
        return($zp);
    }

    /**
     * @param $massive
     * @param $months
     * @param $money
     * @return void
     */
    public function fill_massive(&$massive, $months, $money) {
        foreach($massive as &$spend_year) {
            if ($months >= 12) {
                $spend_year += ($money * 12);
                $months -= 12;
            }
            else {
                $spend_year += ($money * $months);
                break;
            }
        }
    }
}
