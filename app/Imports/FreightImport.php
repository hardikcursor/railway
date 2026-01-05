<?php
namespace App\Imports;

use App\Models\Freight;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FreightImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

    }

    public function model(array $row)
    {
        return new Freight([
            'div'           => $row['div'] ?? null,
            'station_from'  => $row['station_from'] ?? null,
            'station_to'    => $row['station_to'] ?? null,
            'rr_number'     => $row['rr_number'] ?? null,

            'rr_date'       => isset($row['rr_date'])
                ? Carbon::parse($row['rr_date'])
                : null,

            'rr_e_rr'       => $row['rr_e_rr'] ?? null,
            'rr_et_rr'      => $row['rr_et_rr'] ?? null,
            'traffic_type'  => $row['traffic_type'] ?? null,
            'paid_type'     => $row['paid_type'] ?? null,
            'flag'          => $row['flag'] ?? null,

            'invoice_no'    => $row['invoice_no'] ?? null,
            'invoice_date'  => isset($row['invoice_date'])
                ? Carbon::parse($row['invoice_date'])
                : null,

            'cmdt_code'     => $row['cmdt_code'] ?? null,

            'cnsr_code'     => $row['cnsr_code'] ?? null,
            'cnsg_code'     => $row['cnsg_code'] ?? null,
            'eight_wheeler' => $row['8whlr'] ?? null,
            'payment_mode'  => $row['pymt_mode'] ?? null,
            'paid_by'       => $row['paid_by'] ?? null,

            'distance_chrg' => $row['distance_chrg'] ?? 0,
            'weight_chrg'   => $row['weight_chrg'] ?? 0,
            'weight_actl'   => $row['weight_actl'] ?? 0,
            'weight_pol1'   => $row['weight_pol1'] ?? 0,
            'weight_pol2'   => $row['weight_pol2'] ?? 0,

            'chbl_class'    => $row['chbl_class'] ?? null,
            'rate_per_ton'  => $row['rate_t'] ?? 0,
            'basic_frgt'    => $row['basic_frgt'] ?? 0,

            'total_frgt'    => $row['total_frgt'] ?? 0,
            'fr_sort'       => $row['fr_sort'] ?? null,
            'fr_month'      => $row['fr_month'] ?? null,
            'fr_year'       => $row['year'] ?? null,
            'fr_year_2'     => $row['year_2'] ?? null,
        ]);
    }
}
