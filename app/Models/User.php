<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use HasApiTokens {
        tokenCan as traitTokenCan;
    }

    /**
     * @var int
     */
    protected $superAdminRoleId = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'nome_pai',
        'nome_mae',
        'orgao_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function cpf(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
            },
            set: function (string $value) {
                return str_replace([',', '.', '-', ' '], '', $value);
            }
        );
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function orgao()
    {
        return $this->belongsTo(Orgao::class, 'orgao_id', 'id');
    }

    public function isSuperAdmin()
    {
        return $this->roles->where('id', $this->superAdminRoleId)->count() > 0 ? true : false;
    }

    /**
     * Determine if the current API token has a given scope.
     *
     * @param  string  $ability
     * @return bool
     */
    public function tokenCan(string $ability)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->traitTokenCan($ability);
    }
}
