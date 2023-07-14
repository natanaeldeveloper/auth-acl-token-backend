<?php

namespace App\Hateoas;

use App\Models\Orgao;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class OrgaoHateoas
{
    use CreatesLinks;

    public function self(Orgao $orgao) : ?Link
    {
        return $this->link('orgao.show', ['orgao' => $orgao]);
    }

    public function delete(Orgao $orgao) : ?Link
    {
        return $this->link('orgao.destroy', ['orgao' => $orgao]);
    }

    public function update(Orgao $orgao) : ?Link
    {
        return $this->link('orgao.update', ['orgao' => $orgao]);
    }
}
