<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Only create if doesn't exist
        if (!Admin::where('email', 'admin@example.com')->exists()) {
            Admin::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_super_admin' => true,
            ]);
        }

        if (!Admin::where('email', 'manager@example.com')->exists()) {
            Admin::create([
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'is_super_admin' => false,
            ]);
        }
    }
}