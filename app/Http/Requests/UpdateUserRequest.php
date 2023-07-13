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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'nome_pai' => ['max:255'],
            'nome_mae' => ['max:255'],
            'cpf' => ['max:255', Rule::unique('users', 'cpf')->ignore($user)],
            'orgao_id' => ['required', Rule::exists('orgaos', 'id')],
        ];
    }
}
