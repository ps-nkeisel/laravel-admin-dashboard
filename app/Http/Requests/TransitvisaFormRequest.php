<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TransitvisaFormRequest extends FormRequest
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
            'countrytocode' => 'nullable|string|min:0|max:2',

            'visa_freedays' => 'nullable|numeric|min:0',

            'linkresource' => 'required|string|min:10|max:1000',
            'textresource' => 'required|string|min:10|max:1000',
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
        $data = $this->only(['countrytocode', 'required', 'linkresource', 'textresource']);

        $data['no_info_available'] = $this->has('no_info_available');
        $data['exception'] = $this->has('exception');

        $data['visa_free'] = $this->has('visa_free');
        $data['visa_freedays'] = $this->input('visa_freedays', 0);

        $data['active'] = $this->has('active');
        $data['importantchange'] = $this->has('importantchange');
        $data['checkedandok'] = $this->has('checkedandok');
        $data['checkedandnotok'] = $this->has('checkedandnotok');

        $data['archive'] = !$data['active'];

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
