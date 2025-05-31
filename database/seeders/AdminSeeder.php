<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@kapelo.com',
            'password' => Hash::make('Admin@123'),
            'first_name' => 'Administrateur',
            'last_name' => 'System',
            'status' => 'ACTIVE',
            'role' => 'ADMIN'
        ]);
    }
} 