<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'syauqi',
            'email' => 'syauqi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pendaftar',
        ]);

        User::factory()->create([
            'name' => 'budi',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pendaftar',
        ]);

        User::factory()->create([
            'name' => 'siti',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pendaftar',
        ]);

        User::factory()->create([
            'name' => 'andi',
            'email' => 'andi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pendaftar',
        ]);
    }
}
