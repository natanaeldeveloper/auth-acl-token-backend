<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnexoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tipo_anexo_id' => ['required', 'integer', Rule::exists('tipos_anexos', 'id')],
            'descricao' => ['required', 'max:255'],
            'por_arquivo' => ['required', 'boolean'],
            'conteudo' => ['required_if:por_arquivo,false', 'max:6000'],
            'arquivo'  => ['required_if:por_arquivo,true', 'file', 'max:30720'],
        ];
    }

    public function attributes()
    {
        return [
            'tipo_anexo_id' => 'Tipo Anexo',
            'descricao' => 'Descrição',
            'por_arquivo' => 'Por Arquivo',
            'conteudo' => 'Conteúdo',
            'arquivo' => 'Arquivo',
        ];
    }
}
