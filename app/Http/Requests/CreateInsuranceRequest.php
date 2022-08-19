<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;

class CreateInsuranceRequest extends BasicModelRequest
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
            'name' => 'required|string',
            'slug' => 'nullable|string',
            'solution_id' => 'required',
            'image' => 'required|mimes:png,jpg',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
            'content' => 'required|string',
            'status' => 'nullable'
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'insurances';
    }
}