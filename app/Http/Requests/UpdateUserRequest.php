<?php

namespace App\Http\Requests;

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
        $userId = $this->route('user');

        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|' . Rule::unique('users', 'email')->ignore($userId)
        ];
    }
}
