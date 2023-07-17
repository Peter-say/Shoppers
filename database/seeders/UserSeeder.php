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
        User::create([
          'first_name' => 'Peter',
          'last_name' => 'Iriogbe',
          'email' => 'iriogbepeter22@gmail.com',
          'role' => 'Admin',
          'avatar' => null,
          'email_verified_at' => now(),
          'password' => Hash::make('password'),
          'remember_token' => Str::random(10),
        ]);
    }
}
