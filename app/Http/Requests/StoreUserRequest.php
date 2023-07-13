<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreUserRequest extends Request
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'nome_pai' => ['max:255'],
            'nome_mae' => ['max:255'],
            'cpf' => ['max:255', Rule::unique('users', 'cpf')],
            'orgao_id' => ['required', Rule::exists('orgaos', 'id')],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'same:password']
        ];
    }
}
