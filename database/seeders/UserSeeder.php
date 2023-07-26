<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->create([
            [//Admin
                'role' => 'Admin',
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('12345678'),
            ],
            [//Agent
                'role' => 'Agent',
                'name' => 'Agent',
                'email' => 'agent@email.com',
                'password' => Hash::make('12345678'),
            ],
            [//User
                'role' => 'User',
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
