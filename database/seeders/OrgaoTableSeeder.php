<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrgaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Orgao::factory()->create([
            'nome' => 'SOLICITANTE',
            'tipo_orgao_id' => 1,
            'orgao_id' => null,
            'sigla' => 'REQ'
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'DIRETORIA GERAL',
            'tipo_orgao_id' => 1,
            'orgao_id' => null,
            'sigla' => 'DG'
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'DEFOC',
            'tipo_orgao_id' => 1,
            'orgao_id' => null,
            'sigla' => 'DEFOC'
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'DIRETORIA ADMNISTRATIVA',
            'tipo_orgao_id' => 1,
            'orgao_id' => null,
            'sigla' => 'DA'
        ]);

        $cpl = \App\Models\Orgao::factory()->create([
            'nome' => 'CPL',
            'tipo_orgao_id' => 1,
            'orgao_id' => null,
            'sigla' => 'CPL'
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'CÉLULA DE APOIO',
            'tipo_orgao_id' => 2,
            'orgao_id' => $cpl->id,
            'sigla' => null,
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'SERVIDOR 1',
            'tipo_orgao_id' => 2,
            'orgao_id' => $cpl->id,
            'sigla' => null,
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'SERVIDOR 2',
            'tipo_orgao_id' => 2,
            'orgao_id' => $cpl->id,
            'sigla' => null,
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'SERVIDOR 3',
            'tipo_orgao_id' => 2,
            'orgao_id' => $cpl->id,
            'sigla' => null,
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'DIRETOR DE DEPARTAMENTO',
            'tipo_orgao_id' => 2,
            'orgao_id' => $cpl->id,
            'sigla' => null,
        ]);

        \App\Models\Orgao::factory()->create([
            'nome' => 'PROCURADORIA',
            'tipo_orgao_id' => 1,
            'orgao_id' => null,
            'sigla' => 'PROCURADORIA',
        ]);
    }
}
