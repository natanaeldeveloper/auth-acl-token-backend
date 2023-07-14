<?php

namespace App\Hateoas\ACL;

use App\Models\Permission;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class PermissionHateoas
{
    use CreatesLinks;

    public function self(Permission $permission): ?Link
    {
        return $this->link('permission.show', ['permission' => $permission]);
    }

    public function update(Permission $permission): ?Link
    {
        return $this->link('permission.update', ['permission' => $permission]);
    }

    public function remove(Permission $permission): ?Link
    {
        return $this->link('permission.destroy', ['permission' => $permission]);
    }

    public function roles(Permission $permission): ?Link
    {
        return $this->link('permission.role.index', ['permission' => $permission]);
    }

    public function users(Permission $permission): ?Link
    {
        return $this->link('permission.user.index', ['permission' => $permission]);
    }
}
