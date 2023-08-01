<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'orgao' => [
                'id' => $this->orgao->id,
                'nome' => $this->orgao->nome,
                'sigla' => $this->orgao->descricao,
                'tipo_orgao' => [
                    'id' => $this->orgao->tipoOrgao->id,
                    'nome' => $this->orgao->tipoOrgao->nome,
                ],
                'created_at' => $this->orgao->created_at,
                'updated_at' => $this->orgao->updated_at,
            ],
            '_links' => $this->links(),
        ];
    }
}
