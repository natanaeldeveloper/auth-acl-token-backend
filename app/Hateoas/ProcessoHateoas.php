<?php

namespace App\Hateoas;

use App\Models\Processo;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class ProcessoHateoas
{
    use CreatesLinks;

    public function self(Processo $processo) : ?Link
    {
        return $this->link('processo.show', ['processo' => $processo->id]);
    }

    public function update(Processo $processo) : ?Link
    {
        return $this->link('processo.update', ['processo' => $processo->id]);
    }

    public function remove(Processo $processo) : ?Link
    {
        return $this->link('processo.destroy', ['processo' => $processo->id]);
    }
}
