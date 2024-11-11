<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mr Admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Mr User',
            'email' => 'user@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'The Visitor',
            'email' => 'visitor@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);
    }
}
