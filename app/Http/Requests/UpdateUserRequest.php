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
        $userEdit = $this->route('user');

        // usuário a ser editado é super admin mas o usuário logado não possui permissão de edita-lo
        if($userEdit->isSuperAdmin() && !$this->instance()->user()->tokenCan('admin:user')) {
            return false;
        }

        if($this->instance()->user()->tokenCan('user:write')) {
            return true;
        }

        if($this->instance()->user()->tokenCan('user:edit') &&
            $userEdit->id == $this->instance()->user()->id) {
                return true;
        }

        return false;
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
