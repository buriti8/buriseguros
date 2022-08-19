<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;

class CreateNetworkRequest extends BasicModelRequest
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
            'name' => 'required|string|max:191',
            'link' => 'required|url',
            'icon' => 'required|string|max:191',
            'status' => 'nullable'
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'networks';
    }
}