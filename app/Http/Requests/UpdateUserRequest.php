<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends Request
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
        $user = $this->route('user');

        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')->ignore($user)],
            'nome_pai' => ['max:255'],
            'nome_mae' => ['max:255'],
            'cpf' => ['required', 'max:255', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
            'orgao_id' => ['required', Rule::exists('orgaos', 'id')],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'Email',
            'nome_pai' => 'Nome do Pai',
            'nome_mae' => 'Nome ds Mãe',
            'cpf' => 'CPF',
            'orgao_id' => 'Orgão',
            'password' => 'Senha',
            'password_confirmation' => 'Senha de Confirmação',
        ];
    }
}
