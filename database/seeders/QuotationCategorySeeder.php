<?php

namespace Database\Seeders;

use App\Models\QuotationCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $categories = [
            'Booking Office',
            'PRS Office',
            'Parcel Office',
            'Goods Shed/Office',
            'Ticket Examiner Office',
            'Non Fare Revenue at Stations',
            'Inspection of Passenger Amenities Items',
            'STATION CLEANLINESS PROFORMA',
            'Inspection of Pay & Use Toilets',
            'INSPECTION OF TEA & LIGHT REFRESHMENT STALL',
            'Inspection of Pantry Car',
            'INSPECTION OF BASE KITCHEN',
        ];

        foreach ($categories as $category) {
            QuotationCategory::create([
                'name' => $category
            ]);
        }

    }
}
