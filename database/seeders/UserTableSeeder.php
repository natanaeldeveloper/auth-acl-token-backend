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
            'email' => 'superadmin@example.com',
            'password' => Hash::make('12345678'),
        ])->roles()->attach([1]);

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ])->roles()->attach([2]);

        \App\Models\User::factory()->create([
            'name' => 'Usuário Regular',
            'email' => 'regular@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
