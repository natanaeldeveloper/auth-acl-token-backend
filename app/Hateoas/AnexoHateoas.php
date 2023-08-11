<?php

namespace App\Hateoas;

use App\Models\Anexo;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class AnexoHateoas
{
    use CreatesLinks;

    public function self(Anexo $anexo)
    {
        return $this->link('processo.anexo.show', ['processo' => $anexo->processo_id, 'anexo' => $anexo->id]);
    }

    public function update(Anexo $anexo)
    {
        return $this->link('processo.anexo.update', ['processo' => $anexo->processo_id, 'anexo' => $anexo->id]);
    }

    public function delete(Anexo $anexo)
    {
        return $this->link('processo.anexo.destroy', ['processo' => $anexo->processo_id, 'anexo' => $anexo->id]);
    }

    public function download(Anexo $anexo)
    {
        return $this->link('processo.anexo.download', ['processo' => $anexo->processo_id, 'anexo' => $anexo->id]);
    }
}
