<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'], // unique constraint
            [
                'name' => 'Super Admin',
                'password' => Hash::make('SuperAdmin123'), // Change to a secure password
                'role' => 1, // or 'is_super_admin' => true
                'status' => 1,
            ]
        );
    }
}
