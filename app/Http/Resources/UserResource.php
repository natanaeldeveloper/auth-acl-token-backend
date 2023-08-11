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
            'cpf' => $this->cpf,
            'nome_pai' => $this->nome_pai,
            'nome_mae' => $this->nome_mae,
            'orgao' => [
                'id' => $this->orgao->id,
                'nome' => $this->orgao->nome,
                'sigla' => $this->orgao->descricao,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            '_links' => $this->links(),
        ];
    }
}
