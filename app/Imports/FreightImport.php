<?php
namespace App\Imports;

use App\Models\Freight;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class FreightImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        return new Freight([
            'div'          => $row['div'],
            'station_from' => $row['station_from'],
            'station_to'   => $row['station_to'],
            'rr_number'    => $row['rr_number'],
            'rr_date'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['rr_date']),
            'rr_e_rr'      => $row['rr_e_rr'],
            'rr_et_rr'     => $row['rr_et_rr'],
            'traffic_type' => $row['trfc_type'],
            'paid_type'    => $row['paid_type'],
            'flag'         => $row['fl_l_flag'],
            'invoice_no'   => $row['invoice_no'],
            'invoice_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['invoice_date']),
            'cmdt_code'    => $row['cmdt_code'],
        ]);
    }
}
