<?php

namespace App\Hateoas;

use App\Models\Permission;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PermissionHateoas
{
    use CreatesLinks;

    public function self(Permission $permission) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:list')) {
            return null;
        }

        return $this->link('permission.show', ['permission' => $permission]);
    }

    public function update(Permission $permission) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:write')) {
            return null;
        }

        return $this->link('permission.update', ['permission' => $permission]);
    }

    public function remove(Permission $permission) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:write')) {
            return null;
        }

        return $this->link('permission.remove', ['permission' => $permission]);
    }

    public function roles(Permission $permission) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:list')) {
            return null;
        }

        return $this->link('permission.role.update', ['permission' => $permission]);
    }

    public function users(Permission $permission) : ?Link
    {
        if(!request()->user()->tokenCan('user_access:list')) {
            return null;
        }

        return $this->link('permission.user.update', ['permission' => $permission]);
    }
}
