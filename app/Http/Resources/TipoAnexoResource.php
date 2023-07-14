<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoAnexoResource extends JsonResource
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
            'nome' => $this->nome,
            'modelo' => $this->modelo,
            'cor' => $this->cor,
            'requer_assinatura' => $this->requer_assinatura,
            'ativo' => $this->ativo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            '_links' => $this->links(),
        ];
    }
}
