<?php
namespace App\Imports;

use App\Models\NFR_Revenue;
use App\Models\Record;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CombinedImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param Collection $collection
     */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Convert keys to snake_case (lowercase and replace spaces with underscores)
            $row = collect($row)->mapWithKeys(function ($value, $key) {
                $newKey = strtolower(str_replace([' ', '-', '.', '/', '(', ')'], '_', trim($key)));
                return [$newKey => $value];
            })->toArray();

            // Ab apne model mein save karo, saare fields ko safe access karke
            NFR_Revenue::create([
                'station'             => $row['station'] ?? '',
                'location'            => $row['location'] ?? '',
                'station_category'    => $row['station_category'] ?? $row['station_catagory'] ?? '',
                'unit_policy'         => $row['unit_policy'] ?? '',
                'type_of_unit'        => $row['type_of_unit'] ?? '',
                'area_in_sqm'         => is_numeric($row['area_in_sqm'] ?? null) ? $row['area_in_sqm'] : null,
                'period_in_months'    => is_numeric($row['period_in_months'] ?? null) ? $row['period_in_months'] : null,
                'period_start'        => $this->parseDate($row['period_start'] ?? null),
                'expiring_on'         => $this->parseDate($row['expiring_on'] ?? null),
                'yearly_license_fees' => isset($row['yearly_license_fees']) ? str_replace(',', '', $row['yearly_license_fees']) : null,
                'fee_paid_upto_month' => $row['l_fee_paid_up_to_month'] ?? null,
                'fee_paid_upto_rs'    => isset($row['l_fee_paid_up_to_rs']) ? str_replace(',', '', $row['l_fee_paid_up_to_rs']) : null,
            ]);

            Record::create([
                'station'         => $row['station'] ?? '',
                'ur_pass'         => $row['ur_pass'] ?? 0,
                'ur_earning'      => $row['ur_earning'] ?? 0,
                'rsvd_pass'       => $row['rsvd_pass'] ?? 0,
                'rsvd_earning'    => $row['rsvd_earning'] ?? 0,
                'date'            => $this->parseDate($row['date'] ?? null),
                'ur_pass_lakh'    => $row['ur_pass_lakh'] ?? 0,
                'ur_er_cr'        => $row['ur_er_cr'] ?? 0,
                'rsvd_pass_lakh'  => $row['rsvd_pass_lakh'] ?? 0,
                'rsvd_er_cr'      => $row['rsvd_er_cr'] ?? 0,
                'total_pass_lakh' => $row['total_pass_lakh'] ?? 0,
                'total_er_cr'     => $row['total_er_cr'] ?? 0,
                'month'           => $row['Month'] ?? '',
                'm_short'         => $row['m_short'] ?? '',
                'year'            => $row['year'] ?? '',
                'fy'              => $row['fy'] ?? '',
                't_short'         => $row['t_short'] ?? '',
            ]);
        }
    }

    private function parseDate($value)
    {
        try {
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
        } catch (\Exception $e) {
            return null;
        }
    }

}
