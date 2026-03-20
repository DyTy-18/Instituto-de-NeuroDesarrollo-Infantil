<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'indilpzbo@gmail.com'],
            [
                'name'     => 'Admin',
                'email'    => 'indilpzbo@gmail.com',
                'password' => Hash::make('fono_indi_25'),
            ]
        );
    }
}
