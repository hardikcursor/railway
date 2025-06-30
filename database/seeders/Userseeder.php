<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Officer',
            'email' => 'officer@gmail.com',
            'password' =>  Hash::make('officer'),
            'status' => 1,
            
        ];

        $admin = User::create($data);

        $admin->assignRole('user');
    }
}
