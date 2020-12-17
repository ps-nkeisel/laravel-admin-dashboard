<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContentFormRequest extends FormRequest
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
            'archive' => 'nullable|boolean',
            'code1' => 'nullable|string|min:0|max:40',
            'code2' => 'nullable|string|min:0|max:40',
            'code3' => 'nullable|string|min:0|max:40',
            'content1' => 'nullable|string|min:1|max:4294967295',
            'content2' => 'nullable|string|min:1|max:4294967295',
            'destco' => 'nullable|string|min:0|max:2',
            'lang' => 'nullable|string|min:0|max:2',
            'nat' => 'nullable|string|min:0|max:2',
            'position' => 'nullable|numeric|min:0|max:2147483647',
            'text1' => 'nullable|string|min:0|max:100',
            'text2' => 'nullable|string|min:0|max:100',
            'type' => 'nullable|numeric|min:0|max:2147483647',
            'validityfrom' => 'nullable|date_format:Y-m-d',
            'validityto' => 'nullable|date_format:Y-m-d',
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
        $data = $this->only(['active', 'archive', 'assignto', 'category', 'client', 'cluster', 'code1', 'code2', 'code3', 'content1', 'content2', 'destco', 'idversionbefore', 'idversionnext', 'lang', 'nat', 'position', 'tech', 'text1', 'text2', 'type', 'uuid', 'validityfrom', 'validityto', 'version']);

        $data['active'] = $this->has('active');
        $data['archive'] = $this->has('archive');

        return $data;
    }

}
