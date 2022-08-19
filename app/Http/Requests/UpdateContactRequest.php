<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;

class UpdateContactRequest extends BasicModelRequest
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
            'name' => 'sometimes|required|string|max:191',
            'phone' => 'sometimes|required|string|max:191',
            'mobile' => 'sometimes|required|string|max:191',
            'email' => 'sometimes|required|string|email',
            'address' => 'sometimes|required|string|max:191',
            'description' => 'sometimes|required',
            'image' => 'sometimes|required|mimes:png,jpg',
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'contacts';
    }
}
