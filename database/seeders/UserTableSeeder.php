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
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'cpf' => '12345678900',
            'nome_mae' => 'Maria Rocha',
            'nome_pai' => 'Pedro Lucas',
            'orgao_id' => 1,
        ]);
    }
}
