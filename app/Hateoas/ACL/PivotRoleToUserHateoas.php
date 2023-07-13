<?php

namespace App\Hateoas\ACL;

use App\Http\Requests\Request;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PivotRoleToUserHateoas
{
    use CreatesLinks;

    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->route('role');
    }

    public function store() : ?Link
    {
        return $this->link('role.user.store', ['role' => $this->id]);
    }

    public function remove() : ?Link
    {
        return $this->link('role.user.remove', ['role' => $this->id]);
    }

    public function redefine() : ?Link
    {
        return $this->link('role.user.redefine', ['role' => $this->id]);
    }
}
