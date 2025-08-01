<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id'=> 'USER1',
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '0123456789',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'id'=> 'USER2',
            'name' => 'Normal User',
            'username' => 'user',
            'email' => 'user@example.com',
            'phone' => '0987654321',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
        ]);
    }

}

