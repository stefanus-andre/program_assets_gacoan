<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'test',
            'password' => md5('secret'), // Using md5 for consistency with your setup
            'role' => 'admin',
        ]);
    }
}

