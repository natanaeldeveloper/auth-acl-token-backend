<?php

namespace Database\Factories;

use App\Models\Processo;
use App\Models\TipoCaixaPostal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CaixaPostal>
 */
class CaixaPostalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usuariosId = User::select('id')->get()->pluck('id');
        $tiposCaixasPostaisId = TipoCaixaPostal::select('id')->get()->pluck('id');
        $processosId = Processo::select('id')->get()->pluck('id');

        return [
            'usuario_id' => fake()->randomElement($usuariosId),
            'tipo_caixa_postal_id' => fake()->randomElement($tiposCaixasPostaisId),
            'processo_id' => fake()->randomElement($processosId),
        ];
    }
}
