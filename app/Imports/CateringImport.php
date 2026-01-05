<?php
namespace App\Imports;

use App\Models\Catering;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CateringImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
      
        $nsg_part = '';
        foreach ($row as $key => $value) {
            if ((str_starts_with(strtolower($key ?? ''), 'unnamed') || $key === '') && ! empty(trim($value ?? ''))) {
                $nsg_part = trim($value);
                break;
            }
        }
        $category = trim($row['category'] ?? '');
        if ($nsg_part) {
            $category .= ($category ? ', ' : '') . $nsg_part;
        }
        if (empty($category)) {
            $category = 'Unknown';
        }

        $toFloat = function ($value, $default = 0.00) {
            if (is_null($value) || $value === '' || $value === ' ') {
                return $default;
            }
            $cleaned = preg_replace('/[^0-9.-]/', '', $value);
            return (float) $cleaned ?: $default;
        };

        $date     = null;
        $date_str = $row['date_of_commencement'] ?? null;
        if ($date_str && ! in_array(trim($date_str), ['No record', 'Yet to commenced', 'Decades Ago', ''])) {
            try {
                $date = Carbon::createFromFormat('d.m.Y', trim($date_str))->format('Y-m-d');
            } catch (\Exception $e) {
                if (is_numeric($date_str)) {
                    $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_str))->format('Y-m-d');
                }
            }
        }

        return new Catering([
            'name'                 => $row['name_of_unit'] ?? 'Unknown Unit', 
            'name_of_unit'         => $row['name_of_unit'] ?? 'Unknown Unit', 
            'station'              => $row['station'] ?? 'Unknown',      
            'category'             => $category,                         
            'unit_type'            => $nsg_part ?: ($row['type_of_unit'] ?? null),
            'total_units'          => is_numeric($row['sr_no'] ?? null) ? (int) $row['sr_no'] : 1,
            'type_of_unit'         => $row['type_of_unit'] ?? null,
            'platform_no'          => $row['platform_no'] ?? null,
            'annual_license_fee'   => $toFloat($row['annual_license_fee'] ?? 0, 0.00),
            'category_of_unit'     => $row['category_of_unit'] ?? null,
            'unit_allotted'        => $row['unit_alloted'] ?? $row['unit_allotted'] ?? null,
            'annual_fee'           => $toFloat($row['annual_license_fee'] ?? 0, 0.00), 
            'date_of_commencement' => $date,
            'unit_income'          => null,
            'fee_paid'             => 0.00,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
