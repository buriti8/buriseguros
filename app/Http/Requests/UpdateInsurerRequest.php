<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;

class UpdateInsurerRequest extends BasicModelRequest
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
            'name' => 'sometimes|required|string|max:255',
            'link' => 'sometimes|required|url',
            'image' => 'sometimes|required|mimes:png',
            'status' => 'sometimes|nullable'
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'insurers';
    }
}
