<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Coaching;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoachingExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Coaching::select(
            'Name',
            'Station',
            'Unreserved_Passengers',
            'Unreserved_Earning',
            'Reserved_Passengers',
            'Reserved_Earning',
            'Total_Passengers',
            'Total_Earning',
            'Date'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Station',
            'Unreserved Passengers',
            'Unreserved Earning',
            'Reserved Passengers',
            'Reserved Earning',
            'Total Passengers',
            'Total Earning',
            'Date',
        ];
    }
}
