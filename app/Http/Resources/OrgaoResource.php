<?php

namespace App\Http\Resources;

use App\Models\Orgao;
use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrgaoResource extends JsonResource
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
            'tipo_orgao' => [
                'id' => $this->tipoOrgao->id,
                'nome' => $this->tipoOrgao->nome,
            ],
            'orgao_responsavel' => $this->orgaoResponsavel ? [
                'id' => $this->orgaoResponsavel->id,
                'nome' => $this->orgaoResponsavel->nome,
                'sigla' => $this->orgaoResponsavel->sigla,
            ] : null,
            'tipos_anexos' => $this->tiposAnexos->map(function ($tipoAnexo) {
                return [
                    'id' => $tipoAnexo->id,
                    'nome' => $tipoAnexo->nome,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            '_links' => $this->links(),
        ];
    }
}
