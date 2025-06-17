<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\role;
use Spatie\Permission\Models\Permission;
class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = role::create(['name' => 'admin']);
        $role = role::create(['name' => 'super-admin']);
        $role = role::create(['name' => 'user']);
    }
}
