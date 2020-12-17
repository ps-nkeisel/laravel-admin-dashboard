<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EntryFormRequest extends FormRequest
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
        $data = $this->only(['countrytocode', 'linkresource', 'textresource', 'consent']);

        $data['active'] = $this->has('active');
        $data['importantchange'] = $this->has('importantchange');
        $data['checkedandok'] = $this->has('checkedandok');
        $data['checkedandnotok'] = $this->has('checkedandnotok');

        $data['temp_entry_stop'] = $this->has('temp_entry_stop');
        $data['no_info_available'] = $this->has('no_info_available');

        $data['require1'] = $this->has('require1');
        $data['require2'] = $this->has('require2');
        $data['require3'] = $this->has('require3');
        $data['schengen'] = $this->has('schengen');
        $data['supply1'] = $this->has('supply1');
        $data['supply2'] = $this->has('supply2');
        $data['supply3'] = $this->has('supply3');
        $data['supply4'] = $this->has('supply4');

        $data['minor'] = $this->has('minor');
        // $data['require_owniddoc'] = $this->has('require_owniddoc');

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
