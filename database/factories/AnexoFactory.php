<?php

namespace Database\Factories;

use App\Models\Processo;
use App\Models\TipoAnexo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anexo>
 */
class AnexoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $processosId = Processo::select('id')->get()->pluck('id');
        $tiposAnexosId = TipoAnexo::select('id')->get()->pluck('id');
        $editoresId = User::select('id')->get()->pluck('id');

        return [
            'uuid' => fake()->uuid(),
            'processo_id' => fake()->randomElement($processosId),
            'tipo_anexo_id' => fake()->randomElement($tiposAnexosId),
            'numero_anexo' => fake()->randomElement([fake()->randomElement([1,2,3,4,5,6,7,8,9]), null]),
            'mime_type' => fake()->mimeType(),
            'editor_id' => fake()->randomElement($editoresId),
            'descricao' => fake()->text(255),
            'conteudo' => fake()->text(2000),
            'por_arquivo' => fake()->boolean(),
        ];
    }
}
