<?php
namespace App\Imports;

use App\Models\NFR_Revenue;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class NFR_RevenueImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
  public function model(array $row)
{
    // Convert all keys to snake_case
    $row = collect($row)->mapWithKeys(function ($value, $key) {
        $newKey = strtolower(str_replace([' ', '-', '.', '/', '(', ')'], '_', trim($key)));
        return [$newKey => $value];
    })->toArray();

    return new NFR_Revenue([
        'station'             => $row['station'] ?? '',
        'location'            => $row['location'] ?? '',
        'station_category' => $row['station_category'] ?? $row['station_catagory'] ?? '',
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
