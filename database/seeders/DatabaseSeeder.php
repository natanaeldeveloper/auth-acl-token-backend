<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TipoOrgao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(TipoOrgaoTableSeeder::class);
        $this->call(OrgaoTableSeeder::class);
        $this->call(TipoAnexoTableSeeder::class);
        $this->call(TipoAnexoOrgaoTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
