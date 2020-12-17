<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TransitvisainfoFormRequest extends FormRequest
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
            'position' => 'required|numeric|min:0|max:2147483647',
            'content' => 'nullable|string|min:0|max:150',
            'contentcode' => 'nullable|string|min:0|max:5',
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
        $data = $this->only(['position', 'content', 'contentcode']);

        return $data;
    }

    public function getLanguageContents()
    {
        $data = $this->only(['languageContents']);

        return $data['languageContents'];
    }

}
