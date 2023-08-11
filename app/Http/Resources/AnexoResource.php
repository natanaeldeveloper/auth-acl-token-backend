<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;

class AnexoResource extends JsonResource
{
    use HasLinks;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'descricao' => (trim(substr($this->descricao, 0, 50)) . '...'),
            'por_arquivo' => $this->por_arquivo,
            'conteudo' => $this->conteudo,
            'tipo_anexo' => [
                'id' => $this->tipoAnexo->id,
                'nome' => $this->tipoAnexo->nome,
                'cor' => $this->tipoAnexo->cor
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            '_links' => $this->links(),
        ];
    }
}
