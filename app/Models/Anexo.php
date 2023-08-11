<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $table = 'anexos';
    protected $fillable = [
        'uuid',
        'processo_id',
        'tipo_anexo_id',
        'editor_id',
        'numero_anexo',
        'por_arquivo',
        'descricao',
        'conteudo',
        'mime_type',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'processo_id', 'id');
    }

    public function tipoAnexo()
    {
        return $this->belongsTo(TipoAnexo::class, 'tipo_anexo_id', 'id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }
}
