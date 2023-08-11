<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTipoAnexoRequest extends FormRequest
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
        $tipoAnexoId = $this->route('tipo_anexo');

        return [
            'nome' => [
                'required',
                Rule::unique('tipos_anexos', 'nome')->ignore($tipoAnexoId),
            ],
            'modelo' => [],
            'cor' => ['required'],
            'requer_assinatura' => ['required'],
            'ativo' => ['required'],
        ];
    }
}
