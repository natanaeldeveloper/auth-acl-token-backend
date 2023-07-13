<?php

namespace App\Hateoas\ACL;

use App\Http\Requests\Request;
use App\Models\User;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PivotUserToRoleHateoas
{
    use CreatesLinks;

    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->route('user');
    }

    public function store() : ?Link
    {
        return $this->link('user.role.store', ['user' => $this->id]);
    }

    public function remove() : ?Link
    {
        return $this->link('user.role.remove', ['user' => $this->id]);
    }

    public function redefine() : ?Link
    {
        return $this->link('user.role.redefine', ['user' => $this->id]);
    }
}
