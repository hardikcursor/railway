<?php
namespace App\Imports;

use App\Models\Coaching;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class CoachingImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function headingRow(): int
    {
        return 1; // headings are on the first row
    }

    public function model(array $row)
    {
        return new Coaching([
            'Station'               => $row['station'],
            'Unreserved_Passengers' => intval($row['unreserved_passengers']),
            'Unreserved_Earning'    => floatval($row['unreserved_earning']),
            'Reserved_Passengers'   => intval($row['reserved_passengers']),
            'Reserved_Earning'      => floatval($row['reserved_earning']),
            'Total_Passengers'      => intval($row['total_passengers']),
            'Total_Earning'         => floatval($row['total_earning']),
            'Date'                  => $this->parseDate($row['date']),
        ]);
    }

    private function parseDate($value)
    {
        if (is_numeric($value)) {
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

}
