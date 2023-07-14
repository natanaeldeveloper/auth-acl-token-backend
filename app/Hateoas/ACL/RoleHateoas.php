<?php

namespace App\Hateoas\ACL;

use App\Models\Role;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class RoleHateoas
{
    use CreatesLinks;

    public function self(Role $role) : ?Link
    {
        return $this->link('role.show', ['role' => $role]);
    }

    public function update(Role $role) : ?Link
    {
        return $this->link('role.update', ['role' => $role]);
    }

    public function remove(Role $role) : ?Link
    {
        return $this->link('role.destroy', ['role' => $role]);
    }

    public function users(Role $role) : ?Link
    {
        return $this->link('role.user.index', ['role' => $role]);
    }

    public function permissions(Role $role) : ?Link
    {
        return $this->link('role.permission.index', ['role' => $role]);
    }
}
