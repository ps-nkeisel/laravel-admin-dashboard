<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class Infosystem2FormRequest extends FormRequest
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
            'tagdate' => 'required|string|min:1|max:40',
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
        $data = $this->only(['uuid', 'country', 'nat', 'position', 'appearance', 'lang', 'tagtype', 'tagtext', 'tagdate']);
        $data['archive'] = $this->has('archive');
        $data['active'] = $this->has('active');

        $data['info1'] = $this->has('info1');
        $data['info2'] = $this->has('info2');
        $data['info3'] = $this->has('info3');
        $data['info4'] = $this->has('info4');
        $data['entry'] = $this->has('entry');
        $data['visa'] = $this->has('visa');
        $data['transitvisa'] = $this->has('transitvisa');
        $data['health'] = $this->has('health');
        $data['cruise'] = $this->has('cruise');
        $data['corona'] = $this->has('corona');

        return $data;
    }

    public function getParams($params)
    {
        $data = $this->only($params);
        foreach ($params as $param) {
            $data[$param] = isset($data[$param]) ? $data[$param] : [];
        }

        return $data;
    }

}
