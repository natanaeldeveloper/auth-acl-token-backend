<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCaixaPostalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TipoCaixaPostal::factory()->create([
            'nome' => 'Caixa Entrada'
        ]);

        \App\Models\TipoCaixaPostal::factory()->create([
            'nome' => 'Caixa Saída'
        ]);

        \App\Models\TipoCaixaPostal::factory()->create([
            'nome' => 'Caixa de Rascunho'
        ]);
    }
}
