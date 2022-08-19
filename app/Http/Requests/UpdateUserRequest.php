<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BasicModelRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required',
            'last_name' => 'sometimes|nullable',
            'username' => [
                'sometimes',
                'required',
                Rule::unique('users', 'username')->ignore($this->user)
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'password' => 'sometimes|required|confirmed|min:6',
            'is_admin' => 'sometimes|required',
            'role' => 'required_if:is_admin,0',
            'active' => 'sometimes|bool',
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'users';
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'role.required_if' => __('validation.required', ['attribute', $this->attributes()['role'] ?? 'role']),
            'password.confirmed' => 'Confirmación de contraseña no coincide.',
        ];
    }
}
