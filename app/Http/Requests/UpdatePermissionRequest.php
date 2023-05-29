<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends Request
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
        $permissionId = $this->route('permission');

        return [
            'name' => 'required|min:3|max:255|' . Rule::unique('permissions', 'name')->ignore($permissionId),
            'description' => 'required|max:255',
            'permission_id' => 'nullable|'.Rule::exists('permissions','id'),
        ];
    }
}
