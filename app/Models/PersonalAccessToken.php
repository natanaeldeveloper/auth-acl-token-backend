<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{

    protected function abilities(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {

                if($this->tokenable instanceof User) {
                    return $this->getUserAbilities();
                }

                return json_decode($value);
            }
        );
    }

    /**
     * Retorna tanto as permissões do usuário quanto
     * as permissões atreladas aos papeis usuário
     *
     * @return static<array-key, mixed>
     */
    private function getUserAbilities()
    {
        $permissions = DB::select(
            "SELECT
                p.name AS permission_name
                FROM users AS u
                    LEFT JOIN users_roles AS ur
                        ON u.id = ur.user_id
                    LEFT JOIN roles AS r
                        ON ur.role_id = r.id
                    LEFT JOIN roles_permissions AS rp
                        ON r.id = rp.role_id
                    LEFT JOIN users_permissions AS up
                        ON u.id = up.user_id
                    JOIN permissions AS p
                        ON up.permission_id = p.id
                        OR rp.permission_id = p.id
                WHERE u.id = :userId
                GROUP BY
                    p.id,
                    u.id",
            [
                'userId' => $this->tokenable->id,
            ]
        );

        return collect($permissions)->pluck('permission_name')->toArray() ?? [];
    }
}
