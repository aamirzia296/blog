<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'test',
                'password' => bcrypt('test1234'),
                'role' => 'admin'
            ]
        );
    }
}
