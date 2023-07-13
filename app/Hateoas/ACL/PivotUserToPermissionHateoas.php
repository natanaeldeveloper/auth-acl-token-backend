<?php

namespace App\Hateoas\ACL;

use App\Http\Requests\Request;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PivotUserToPermissionHateoas
{
    use CreatesLinks;

    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->route('user');
    }

    public function store() : ?Link
    {
        return $this->link('user.permission.store', ['user' => $this->id]);
    }

    public function remove() : ?Link
    {
        return $this->link('user.permission.remove', ['user' => $this->id]);
    }

    public function redefine() : ?Link
    {
        return $this->link('user.permission.redefine', ['user' => $this->id]);
    }
}
