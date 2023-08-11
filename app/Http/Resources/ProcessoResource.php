<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcessoResource extends JsonResource
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
            'valor_estimado' => $this->valor_estimado,
            'objeto' => $this->objeto,
            'ano_processo' => $this->ano_processo,
            'numero_processo' => $this->numero_processo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'solicitante' => [
                'id' => $this->solicitante->id,
                'name' => $this->solicitante->name,
                'email' => $this->solicitante->email,
            ],
            '_links' => $this->links()
        ];
    }
}
