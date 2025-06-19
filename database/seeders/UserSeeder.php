<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // user 1
        User::firstOrCreate(
            ['email' => 'user1@gmail.com'],
            [
                'name' => 'User 1',
                'password' => Hash::make('123'), 
            ]
        );

        // user 2
        User::firstOrCreate(
            ['email' => 'user2@gmail.com'], 
            [
                'name' => 'User 2',
                'password' => Hash::make('123'), 
            ]
        );
    }
}
