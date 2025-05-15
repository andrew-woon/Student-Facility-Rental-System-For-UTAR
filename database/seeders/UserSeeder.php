<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Test User $i",
                'school_id' => Str::padLeft(rand(2000000, 2600000), 7, '0'),
                'email' => "testuser$i@1utar.my",
                'phone' => '0123456789',
                'password' => Hash::make("testuser$i@1utar.my"),
                'role' => 'user',
            ]);
        }
    }
}
