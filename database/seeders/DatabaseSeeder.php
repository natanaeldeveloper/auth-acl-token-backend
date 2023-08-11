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
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        $this->call(TipoOrgaoTableSeeder::class);
        $this->call(OrgaoTableSeeder::class);

        $this->call(UserTableSeeder::class);

        $this->call(TipoAnexoTableSeeder::class);
        $this->call(TipoAnexoOrgaoTableSeeder::class);

        $this->call(TipoCaixaPostalSeeder::class);

        $this->call(ProcessoSeeder::class);
        $this->call(AnexoSeeder::class);

        $this->call(CaixaPostalSeeder::class);


    }
}
