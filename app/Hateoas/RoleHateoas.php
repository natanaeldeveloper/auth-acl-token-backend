<?php

namespace App\Hateoas;

use App\Models\Role;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class RoleHateoas
{
    use CreatesLinks;

    public function self(Role $role) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:list')) {
            return null;
        }

        return $this->link('role.show', ['role' => $role]);
    }

    public function update(Role $role) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:write')) {
            return null;
        }

        return $this->link('role.update', ['role' => $role]);
    }

    public function remove(Role $role) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:write')) {
            return null;
        }

        return $this->link('role.destroy', ['role' => $role]);
    }

    public function users(Role $role) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:list')) {
            return null;
        }

        return $this->link('role.user.index', ['role' => $role]);
    }

    public function permissions(Role $role) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:list')) {
            return null;
        }

        return $this->link('role.permission.index', ['role' => $role]);
    }
}
