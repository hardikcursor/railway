<?php
namespace App\Imports;

use App\Models\Coaching;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

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
        if (empty($row['station'])) {
            return null; // skip row if station missing
        }

        return new Coaching([
            'Station'               => trim($row['station']),
            'Unreserved_Passengers' => (int) ($row['unreserved_passengers'] ?? 0),
            'Unreserved_Earning'    => (float) ($row['unreserved_earning'] ?? 0),
            'Reserved_Passengers'   => (int) ($row['reserved_passengers'] ?? 0),
            'Reserved_Earning'      => (float) ($row['reserved_earning'] ?? 0),
            'Date'                  => $this->parseDate($row['date'] ?? null),
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
