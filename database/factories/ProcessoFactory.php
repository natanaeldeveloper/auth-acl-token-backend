<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Processo>
 */
class ProcessoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $solicitantesId = User::select('id')->get()->pluck('id');

        return [
            'valor_estimado' => number_format(fake()->randomFloat(2, 0, 1000000000), 2, ',', '.'),
            'objeto' => fake()->text(500),
            'numero_processo' => fake()->randomNumber() . '/2023',
            'ano_processo' => 2023,
            'solicitante_id' => fake()->randomElement($solicitantesId)
        ];
    }
}
