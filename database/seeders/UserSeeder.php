<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Agent',
            'email' => 'agent@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'staff'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);
    }
}
