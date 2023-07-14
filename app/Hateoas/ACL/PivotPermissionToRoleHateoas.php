<?php

namespace App\Hateoas\ACL;

use App\Http\Requests\Request;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PivotPermissionToRoleHateoas
{
    use CreatesLinks;

    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->route('permission');
    }

    public function store() : ?Link
    {
        return $this->link('permission.role.store', ['permission' => $this->id]);
    }

    public function remove() : ?Link
    {
        return $this->link('permission.role.remove', ['permission' => $this->id]);
    }

    public function redefine() : ?Link
    {
        return $this->link('permission.role.redefine', ['permission' => $this->id]);
    }
}
