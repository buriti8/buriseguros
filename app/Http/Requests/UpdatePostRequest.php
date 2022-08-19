<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\BasicModelRequest;

class UpdatePostRequest extends BasicModelRequest
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
            'title' => 'sometimes|required|string',
            'slug' => 'sometimes|nullable|string',
            'description' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'image' => 'sometimes|required|mimes:png,jpg',
            'category_id' => 'sometimes|required',
            'status' => 'sometimes|nullable'
        ];
    }

    /**
     * @return string
     */
    protected function getLangFile(): string
    {
        return 'posts';
    }
}
