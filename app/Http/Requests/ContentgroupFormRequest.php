<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContentgroupFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'contentadditionalable_type' => 'required|string|min:1|max:255',
            'section' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:40',
        ];

        return $rules;
    }

    /**
     * Get the request's data from the request.
     *
     *
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['contentadditionalable_type', 'section', 'content', 'code']);

        return $data;
    }

}
