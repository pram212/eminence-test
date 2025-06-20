<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => "Developer",
                'email' => "developer@example.com",
                'email_verified_at' => now(),
                'role' => "developer",
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Administrator",
                'email' => "admin@example.com",
                'email_verified_at' => now(),
                'role' => "admin",
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
        ]);

        User::factory(8)->create();
    }
}
