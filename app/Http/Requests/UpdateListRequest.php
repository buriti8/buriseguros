<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateListRequest extends CreateListRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'list_name' => 'sometimes|required',
            'option' => [
                'sometimes',
                'required',
            ],
            'option_key' => 'sometimes|nullable',
            'status' => 'sometimes|bool',
        ];
    }
}
