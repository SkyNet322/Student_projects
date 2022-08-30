<?php

namespace App\Exports;

use App\Models\Connect;
use App\Models\Calculate;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CalculateExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles
{
    protected $connect;

    public function __construct(connect $connect)
    {
        $this->connect = $connect;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $calculate = (new Calculate())->getCalculate($this->connect);

        array_unshift($calculate['tsoCAPEX'], 'ТСО / В год CAPEX', null);
        array_unshift($calculate['tsoOPEX'], 'ТСО / В год OPEX', null);
        array_unshift($calculate['support'], 'Команда сопровождения', null);
        array_unshift($calculate['development'], 'Команда развития', null);

        return $calculate;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            "Статья затрат",
            "Вид затрат",
            "1-ый год",
            "2-ый год",
            "3-ый год",
            "4-ый год",
            "5-ый год",
            "Всего"
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 55,
            'B' => 20,
        ];
    }
}
?>
