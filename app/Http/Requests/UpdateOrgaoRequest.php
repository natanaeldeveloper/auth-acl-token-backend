<?php

namespace App\Http\Requests;

use App\Rules\ArrayExistsInDatabase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrgaoRequest extends FormRequest
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
        $orgaoId = $this->route('orgao');

        return [
            'tipo_orgao_id' => [
                'required',
                Rule::exists('tipos_orgaos', 'id'),
            ],
            'orgao_id' => [
                // orgão do tipo 'CÉLULA' pertence a outro orgão do tipo 'UNIDADE'
                'required_if:tipo_orgao_id,2',
                Rule::exists('orgaos', 'id'),
            ],
            'nome' => [
                'required',
                'max:255',
                Rule::unique('orgaos', 'nome')->ignore($orgaoId),
            ],
            'sigla' => [
                'nullable',
                'max:255',
            ],
            'tipos_anexo_id' => [
                new ArrayExistsInDatabase('tipos_anexos', 'id'),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'tipo_orgao_id' => 'Tipo de Orgão',
            'orgao_id' => 'Unidade Responsável',
            'nome' => 'Nome',
            'sigla' => 'Sigla',
            'tipos_anexo_id' => 'Tipos de Anexos'
        ];
    }

    public function messages()
    {
        return [
            'orgao_id.required_if' => "O campo :attribute é obrigatório quando o tipo de orgão for 'CÉLULA'.",
            'orgao_id.nullable_if' => "O campo :attribute deve ser vazio quando o tipo de orgão for 'UNIDADE'.",
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'orgao_id' => $this->tipo_orgao_id == 2 ? $this->orgao_id : null,
        ]);
    }
}
