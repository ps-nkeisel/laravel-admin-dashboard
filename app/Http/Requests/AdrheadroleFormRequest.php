<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AdrheadroleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'content_de' => 'nullable|string|max:45',
            'content_en' => 'nullable|string|max:45',
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
        $data = $this->only(['content_de', 'content_en']);

        $data['active'] = $this->has('active');

        return $data;
    }

}
