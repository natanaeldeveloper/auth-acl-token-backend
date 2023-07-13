<?php

namespace App\Hateoas\ACL;

use App\Http\Requests\Request;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PivotRoleToPermissionHateoas
{
    use CreatesLinks;

    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->route('role');
    }

    public function store() : ?Link
    {
        return $this->link('role.permission.store', ['role' => $this->id]);
    }

    public function remove() : ?Link
    {
        return $this->link('role.permission.remove', ['role' => $this->id]);
    }

    public function redefine() : ?Link
    {
        return $this->link('role.permission.redefine', ['role' => $this->id]);
    }
}
