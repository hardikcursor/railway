<?php
namespace App\Imports;

use App\Models\Outward_Freight_Register;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

    class Outward_Freight_RegisterImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
    {
        public function model(array $row)
        {
            $row = collect($row)->mapWithKeys(function ($value, $key) {
                $newKey = strtolower(str_replace([' ', '-', '.', '/', '(', ')'], '_', trim($key)));
                return [$newKey => $value];
            })->toArray();

            // ✅ Skip if all values are null or empty
            if (collect($row)->filter()->isEmpty()) {
                return null;
            }

            return new Outward_Freight_Register([
                'dvsn'         => $row['dvsn'] ?? null,
                'station_from' => $row['station_from'] ?? null,
                'station_to'   => $row['station_to'] ?? null,
                'rr_number'    => $row['rr_number'] ?? null,
                'rr_date'      => $this->parseDate($row['rr_date'] ?? null),
                'invoice_date' => $this->parseDate($row['invoice_date'] ?? null),
                'cmdt_code'    => $row['cmdt_code'] ?? null,
                '8_WHLR'       => $row['8_whlr'] ?? null,
                'weight_chrg'  => $row['weight_chrg'] ?? null,
                'total_frgt'   => $row['total_frgt'] ?? null,
                'siding_type'  => $row['siding_type'] ?? null,
                'rake_type'    => $row['rake_type'] ?? null,
                'wagon_type'   => $row['wagon_type'] ?? null,
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
