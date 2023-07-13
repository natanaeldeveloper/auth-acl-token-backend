<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@fabricainfo.com',
            'password' => Hash::make('superadmin@2023'),
        ])->roles()->attach([1]);

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@fabricainfo.com',
            'password' => Hash::make('admin@2023'),
        ])->roles()->attach([2]);

        \App\Models\User::factory()->create([
            'name' => 'Moderador',
            'email' => 'moderador@fabricainfo.com',
            'password' => Hash::make('moderador@2023'),
        ])->roles()->attach([3]);
    }
}
