<?php

namespace App\Http\Requests\ACL;

use App\Http\Requests\Request;
use App\Rules\ArrayExistsInDatabase;

class PivotPermissionToRoleRequest extends Request
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
            'roles' => [
                'nullable',
                'array',
                new ArrayExistsInDatabase('roles', 'id'),
            ]
        ];
    }
}
