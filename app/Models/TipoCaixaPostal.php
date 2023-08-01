<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCaixaPostal extends Model
{
    use HasFactory;

    protected $table = 'tipos_caixas_postais';

    public static $tipoCaixaDeEntradaId = 1;

    public static $tipoCaixaDeSaidaId = 2;

    public static $tipoCaixaDeRascunhoId = 3;

    protected $fillable = [
        'descricao'
    ];

    public $timestamps = false;

    public function caixasPostais()
    {
        return $this->hasMany(CaixaPostal::class, 'tipo_caixa_postal_id', 'id');
    }
}
