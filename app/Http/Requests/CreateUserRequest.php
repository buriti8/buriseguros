<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends BasicModelRequest
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
            'name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6',
            'is_admin' => 'required',
            'role' => 'required_if:is_admin,0',
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'users';
    }
}
