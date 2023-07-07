<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoAnexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'DOCUMENTO DE FORMALIZAÇÃO DA DEMANDA (SOLICITAÇÃO DO ÓRGÃO REQUISITANTE)',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'AUTORIZAÇÃO DA DIRETORIA GERAL',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'OFÍCIO DE SOLICITAÇÃO PARA ÓRGÃO GESTOR DE ATA DE REGISTRO DE PREÇO',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'CONCORDÂNCIA DO ÓRGÃO GESTOR DA ATA DE REGISTRO DE PREÇO',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'OFÍCIO DE SOLICITAÇÃO PARA EMPRESA DETENTORA DE ATA DE REGISTRO DE PREÇO',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'CONCORDÂNCIA DA EMPRESA DETENTORA DE ATA DE REGISTRO DE PREÇO',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'TERMO DE REFERÊNCIA*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'ESTUDO TÉCNICO PRELIMINAR',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'PROJETO BÁSICO*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'MAPA COMPARATIVO DE PREÇOS',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'PESQUISA DE PREÇOS',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'SOLICITAÇÃO DE DESPESA - SD',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'AUTORIZAÇÃO DE DESPESA - AD',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'JUSTIFICATIVA PARA PREGÃO PRESENCIAL*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'AUTUAÇÃO DO PROCESSO E DESIGNAÇÃO RESPONSÁVEL (PRIMEIRA DESIGNAÇÃO',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'ATO DE NOMEAÇÃO DA EQUIPE DO PREGÃO*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'ATO DE NOMEAÇÃO DA COMISSÃO PERMANENTE DE LICITAÇÃO*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'DESPACHO DE DILIGÊNCIA DO PROCESSO*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'PARECER JURÍDICO ',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'MINUTA DO TERMO JUSTIFICATIVO',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);

        \App\Models\TipoAnexo::factory()->create([
            'nome' => 'TERMO JUSTIFICATIVO*',
            'modelo' => fake()->paragraph(),
            'cor' => fake()->hexColor(),
            'requer_assinatura' => fake()->boolean(),
            'ativo' => fake()->boolean(),
        ]);
    }
}
