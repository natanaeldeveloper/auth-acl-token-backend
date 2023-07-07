<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@fabricainfo.com',
            'password' => Hash::make('admin@2023'),
        ]);

        DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), 1, false)");
    }
}
