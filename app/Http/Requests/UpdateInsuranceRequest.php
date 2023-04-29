<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;

class UpdateInsuranceRequest extends BasicModelRequest
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
            'name' => 'sometimes|required|string',
            'slug' => 'sometimes|nullable|string',
            'solution_id' => 'sometimes|required',
            'image' => 'sometimes|required|mimes:png,jpg',
            'icon' => 'sometimes|required|string|max:191',
            'description' => 'sometimes|required|string',
            'pre_content' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'status' => 'sometimes|nullable'
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
