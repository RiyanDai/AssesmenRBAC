<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // Admin role
        ]);

       
        $manager = User::create([
            'name' => 'John Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Manager role
        ]);

        
        User::create([
            'name' => 'Riyan',
            'email' => 'riyan@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // User role
            'manager_id' => $manager->id,
        ]);
        

        User::create([
            'name' => 'Dewi',
            'email' => 'dewi@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // User role
            'manager_id' => $manager->id,
        ]);
    }
}


//test