<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaixaPostal extends Model
{
    use HasFactory;

    protected $table = 'caixas_postais';

    protected $fillable = [
        'usuario_id',
        'tipo_caixa_postal_id',
        'processo_id',
    ];

    public function tipoCaixaPostal()
    {
        return $this->belongsTo(TipoCaixaPostal::class, 'tipo_caixa_postal_id', 'id');
    }

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'processo_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function isCaixaEntrada()
    {
        return $this->tipo_caixa_postal === 1;
    }

    public function isCaixaSaida()
    {
        return $this->tipo_caixa_postal === 2;
    }

    public function isCaixaRascunho()
    {
        return $this->tipo_caixa_postal === 3;
    }
}
