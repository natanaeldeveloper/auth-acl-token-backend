<?php

namespace App\Hateoas;

use App\Models\User;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class UserHateoas
{
    use CreatesLinks;

    public function self(User $user) : ?Link
    {
        return $this->link('user.show', ['user' => $user]);
    }

    public function update(User $user) : ?Link
    {
        return $this->link('user.update', ['user' => $user]);
    }

    public function delete(User $user) : ?Link
    {
        return $this->link('user.destroy', ['user' => $user]);
    }

    public function permissions(User $user) : ?Link
    {
        return $this->link('user.permission.index', ['user' => $user]);
    }

    public function roles(User $user) : ?Link
    {
        return $this->link('user.role.index', ['user' => $user]);
    }
}
