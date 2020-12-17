<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UseractionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*
    public function authorize()
    {
        return false;
    }
    */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'active' => 'nullable|boolean',
            'assigntonew' => 'nullable|numeric|min:0|max:2147483647',
            'assigntoold' => 'nullable|numeric|min:0|max:2147483647',
            'assigntype' => 'nullable|numeric|min:0|max:2147483647',
            'comment' => 'nullable|string|min:0|max:192',
            'type' => 'nullable|numeric|min:0|max:2147483647',
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
        $data = $this->only(['assigntonew', 'assigntoold', 'assigntype', 'comment', 'type']);
        $data['active'] = $this->has('active');

        return $data;
    }

}
