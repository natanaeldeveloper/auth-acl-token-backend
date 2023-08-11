<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    use HasFactory;

    protected $table = 'orgaos';

    protected $fillable = [
        'tipo_orgao_id',
        'orgao_id',
        'nome',
        'sigla',
    ];

    public function tipoOrgao()
    {
        return $this->belongsTo(TipoOrgao::class, 'tipo_orgao_id', 'id');
    }

    public function tiposAnexos()
    {
        return $this->belongsToMany(TipoAnexo::class, 'tipos_anexos_orgaos', 'orgao_id', 'tipo_anexo_id');
    }

    public function orgaoResponsavel()
    {
        return $this->belongsTo(Orgao::class, 'orgao_responsavel_id', 'id');
    }

    public function orgaosPertencentes()
    {
        return $this->hasMany(Orgao::class, 'orgao_responsavel_id', 'id');
    }
}
