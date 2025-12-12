<?php
namespace Database\Seeders;

use App\Models\User;
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
            'name'     => 'Officer',
            'email'    => 'officer@gmail.com',
            'password' => Hash::make('officer'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'Officer-DCM|FM',
            'email'    => 'Officer-DCM|FM@gmail.com',
            'password' => Hash::make('Officer-DCM|FM'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'Officer-DCM|PM',
            'email'    => 'Officer-DCM|PM@gmail.com',
            'password' => Hash::make('Officer-DCM|PM'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'Officer-ACM|PM',
            'email'    => 'Officer-ACM|PM@gmail.com',
            'password' => Hash::make('Officer-ACM|PM'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'Officer-ACM|FM',
            'email'    => 'Officer-ACM|FM@gmail.com',
            'password' => Hash::make('Officer-ACM|FM'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'Officer-ACM|CH',
            'email'    => 'Officer-ACM|CH@gmail.com',
            'password' => Hash::make('Officer-ACM|CH'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|FRT',
            'email'    => 'DCMIFRT@gmail.com',
            'password' => Hash::make('DCMI|FRT'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|PLG',
            'email'    => 'DCMIPLG@gmail.com',
            'password' => Hash::make('DCMI|PLG'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|CHG',
            'email'    => 'DCMICHG@gmail.com',
            'password' => Hash::make('DCMI|CHG'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|STS',
            'email'    => 'DCMI|STS@gmail.com',
            'password' => Hash::make('DCMI|STS'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|HR',
            'email'    => 'DCMI|HR@gmail.com',
            'password' => Hash::make('DCMI|HR'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'CTI',
            'email'    => 'CTI@gmail.com',
            'password' => Hash::make('CTI'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|NFR',
            'email'    => 'DCMINFR@gmail.com',
            'password' => Hash::make('DCMI|NFR'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCM|CATH',
            'email'    => 'DCMICATH@gmail.com',
            'password' => Hash::make('DCMI|CATH'),
            'status'   => 1,
        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'DCMI|EXP',
            'email'    => 'DCMIEXP@gmail.com',
            'password' => Hash::make('DCMI|EXP'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

        $data = [
            'name'     => 'OS|GENERAL',
            'email'    => 'OSGENERAL@gmail.com',
            'password' => Hash::make('OS|GENERAL'),
            'status'   => 1,

        ];

        $admin = User::create($data);

        $admin->assignRole('super-admin');

    }

}
