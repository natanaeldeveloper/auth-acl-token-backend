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

        $porArquivo = fake()->boolean();

        return [
            'uuid' => fake()->uuid(),
            'processo_id' => fake()->randomElement($processosId),
            'tipo_anexo_id' => fake()->randomElement($tiposAnexosId),
            'numero_anexo' => fake()->randomElement([fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]), null]),
            'mime_type' => fake()->mimeType(),
            'editor_id' => fake()->randomElement($editoresId),
            'descricao' => fake()->text(255),
            'por_arquivo' => $porArquivo,
            'conteudo' => !$porArquivo ?
                '<h1>Hello World</h1>
                <h3>Subtítulo do texto</h3>
                <p><strong>Lorem ipsum dolor sit amet, consectetur adipisc</strong>ing elit. Donec ullamcorper enim nisi, ac euismod sapien gravida
                    sed. Proin ac massa placerat lorem aliquet consequat sit amet eu sapien. <i>Pellentesque venenatis lectus magna,
                    nec porta tellus ornare eget. Aliquam sagittis</i> ti <code>ncidunt pellentesque. Mauris porta ut turpi</code> s ac ultrices. Nunc
                    commodo ligula quam, vestibulum laoreet elit tempus in. <a href="https://google.com">Maecenas vitae consectetur turpis</a>. Donec a dui eleifend,
                    ultricies ipsum ac, elementum turpis.</p>' : null,
        ];
    }
}
