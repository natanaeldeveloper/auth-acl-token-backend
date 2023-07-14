<?php

namespace App\Hateoas\ACL;

use App\Http\Requests\Request;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PivotPermissionToUserHateoas
{
    use CreatesLinks;

    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->route('permission');
    }

    public function store() : ?Link
    {
        return $this->link('permission.user.store', ['permission' => $this->id]);
    }

    public function remove() : ?Link
    {
        return $this->link('permission.user.remove', ['permission' => $this->id]);
    }

    public function redefine() : ?Link
    {
        return $this->link('permission.user.redefine', ['permission' => $this->id]);
    }
}
