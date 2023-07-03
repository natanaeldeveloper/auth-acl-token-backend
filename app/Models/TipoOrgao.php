<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOrgao extends Model
{
    use HasFactory;

    protected $table = 'tipos_orgaos';

    protected $fillable = [
        'nome',
    ];

    public function orgaos()
    {
        return $this->hasMany(Orgao::class, 'tipo_orgao_id', 'id');
    }
}
