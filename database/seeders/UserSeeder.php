<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager12345'),
            'role' => 'manager'
        ]);

        $spv = User::create([
            'name' => 'spv',
            'email' => 'spv@gmail.com',
            'password' => Hash::make('spv12345'),
            'role' => 'spv'
        ]);

        $staff = User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff12345'),
            'role' => 'staff'
        ]);
    }
}
