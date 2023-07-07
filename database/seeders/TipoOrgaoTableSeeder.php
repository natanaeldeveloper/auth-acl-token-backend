<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoOrgaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TipoOrgao::factory()->create([
            'id' => 1,
            'nome' => 'UNIDADE',
        ]);

        \App\Models\TipoOrgao::factory()->create([
            'id' => 2,
            'nome' => 'CÉLULA',
        ]);
    }
}
