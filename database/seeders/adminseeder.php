<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Divisional Supervisor',
            'email' => 'divisionalsupervisor@gmail.com',
            'password' =>  Hash::make('divisional'),
            'status' => 1,
            
        ];

        $admin = User::create($data);

        $admin->assignRole('admin');
    }
}
