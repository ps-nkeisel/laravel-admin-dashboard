<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class InfosystemFormRequest extends FormRequest
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
            'position' => 'required|numeric|min:0|max:1000',
            'appearance' => 'required',
            'tagtype' => 'required|not_in:0',
            'tagtext' => 'required|string|min:1|max:40',
            'tagdate' => 'required|string|min:1|max:40',
            'header' => 'required|string|min:3|max:100'
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
        $data = $this->only(['info1', 'info2', 'info3', 'info4', 'entry','visa','transitvisa','health', 'cruise',
            'corona', 'country', 'nat', 'uuid', 'position', 'appearance', 'lang', 'tagtype', 'tagtext', 'tagdate',
            'header', 'content', 'controlled_at']);
        $data['archive'] = $this->has('archive');
        $data['active'] = $this->has('active');

        return $data;
    }

}
