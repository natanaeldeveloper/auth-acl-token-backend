<?php

namespace App\Http\Requests\Pivot;

use App\Http\Requests\Request;
use App\Rules\ArrayExistsInDatabase;

class PivotRoleToUserRequest extends Request
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
            'users' => [
                'nullable',
                'array',
                new ArrayExistsInDatabase('users', 'id'),
            ]
        ];
    }
}
