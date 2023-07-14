<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAnexo extends Model
{
    use HasFactory;

    protected $table = 'tipos_anexos';

    protected $fillable = [
        'nome',
        'modelo',
        'cor',
        'requer_assinatura',
        'ativo'
    ];

    public function orgaos()
    {
        return $this->belongsToMany(Orgao::class, 'tipo_anexo_id', 'orgao_id');
    }

}
