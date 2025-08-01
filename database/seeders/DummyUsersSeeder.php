<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('users')->insert([
            [
                'id'       => 4,
                'name'     => 'ajay',
                'email'    => 'cursorsoft776@gmail.com',
                'phone'    => '1234567890',
                'designation' => 'Booking Office',
                'incharge_name' => 'Ajay Kumar',
                'password' => Hash::make('password123'),
                'status'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
