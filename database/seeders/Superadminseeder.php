<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Superadminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'password' =>  Hash::make('supervisor'),
             'status' => 1,
            
        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');
    }
}
