<?php

namespace App\Hateoas;

use App\Models\CaixaPostal;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class CaixaPostalHateoas
{
    use CreatesLinks;

    public function self(CaixaPostal $caixaPostal) : ?Link
    {
        return $this->link('processo.show', ['processo' => $caixaPostal->processo_id]);
    }

    public function update(CaixaPostal $caixaPostal) : ?Link
    {
        return $this->link('processo.update', ['processo' => $caixaPostal->processo->id]);
    }

    public function delete(CaixaPostal $caixaPostal) : ?Link
    {
        return $this->link('processo.destroy', ['processo' => $caixaPostal->processo->id]);
    }
}

