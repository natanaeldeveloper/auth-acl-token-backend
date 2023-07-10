<?php

namespace App\Hateoas;

use App\Models\TipoAnexo;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class TipoAnexoHateoas
{
    use CreatesLinks;

    public function self(TipoAnexo $tipoAnexo) : ?Link
    {
        return $this->link('tipoAnexo.show', ['tipo_anexo' => $tipoAnexo]);
    }

    public function delete(TipoAnexo $tipoAnexo) : ?Link
    {
        return $this->link('tipoAnexo.destroy', ['tipo_anexo' => $tipoAnexo]);
    }

    public function update(TipoAnexo $tipoAnexo) : ?Link
    {
        return $this->link('tipoAnexo.update', ['tipo_anexo' => $tipoAnexo]);
    }
}
