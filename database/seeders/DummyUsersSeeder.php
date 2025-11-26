<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $data = [
            'name'          => 'cursorsoft',
            'email'         => 'cursorsoft776@gmail.com',
            'phone'         => '1234567890',
            'designation'   => 'Booking Office',
            'incharge_name' => 'Ajay Kumar',
            'password'      => Hash::make('cursorsoft'),
            'status'        => 1,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];

        $admin = User::create($data);

        $admin->assignRole('user');
    }
}
