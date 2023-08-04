<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaixaPostalResource extends JsonResource
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
            'processo' => [
                'id' => $this->processo->id,
                'valor_estimado' => $this->processo->valor_estimado,
                'data_solicitacao' => $this->processo->created_at->format('d/m/Y'),
                'objeto' => (trim(substr($this->processo->objeto, 0, 50)) . '...'),
                'solicitante_nome' => $this->processo->solicitante->nome,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            '_links' => $this->links()
        ];
    }
}
