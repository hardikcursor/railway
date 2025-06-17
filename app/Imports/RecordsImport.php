<?php
namespace App\Imports;

use App\Models\Record;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class RecordsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $row = collect($row)->mapWithKeys(function ($value, $key) {
            $newKey = strtolower(str_replace([' ', '-', '.', '/', '(', ')'], '_', trim($key)));
            return [$newKey => $value];
        })->toArray();

        
        return new Record([
            'Station'         => $row['station'],
            'UR_Pass'         => $row['ur_pass'],
            'UR_Earning'      => $row['ur_earning'],
            'Rsvd_Pass'       => $row['rsvd_pass'],
            'Rsvd_Earning'    => $row['rsvd_earning'],
            'Date'            => $this->parseDate($row['date']),
            'UR_Pass_Lakh'    => $row['ur_pass_lakh'],
            'UR_Er_Cr'        => $row['ur_er_cr'],
            'Rsvd_Pass_Lakh'  => $row['rsvd_pass_lakh'],
            'Rsvd_Er_Cr'      => $row['rsvd_er_cr'],
            'Total_Pass_Lakh' => $row['total_pass_lakh'],
            'Total_Er_Cr'     => $row['total_er_cr'],
            'Month'           => $row['month'] ?? '',
            'M_short'         => $row['m_short'],
            'Year'            => $row['year'],
            'FY'              => $row['fy'],
            'T_short'         => $row['t_short'],
        ]);
    }

    private function parseDate($value)
    {
        try {
            if (is_numeric($value)) {
                return Carbon::instance(ExcelDate::excelToDateTimeObject($value))->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
