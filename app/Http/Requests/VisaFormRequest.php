<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class VisaFormRequest extends FormRequest
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
            // 'uuid' => 'required|string|min:1|max:36',

            'countrytocode' => 'nullable|string|min:0|max:2',

            'evisalink' => 'nullable|string',

            'linkresource' => 'required|string|min:10|max:1000',
            'textresource' => 'required|string|min:10|max:1000',

            'freedays' => 'nullable|numeric|min:0',

            'online_handlingtime_from' => 'nullable|numeric|min:0',
            'online_handlingtime_to' => 'nullable|numeric|min:0',

            'foreign_handlingtime_from' => 'nullable|numeric|min:0',
            'foreign_handlingtime_to' => 'nullable|numeric|min:0',
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
        $data = $this->only(['countrytocode', 'evisalink', 'linkresource', 'textresource',
            'require1',
            'online_handlingtime_from', 'online_handlingtime_to',
            'foreign_handlingtime_from', 'foreign_handlingtime_to',
        ]);

        $data['active'] = $this->has('active');
        $data['importantchange'] = $this->has('importantchange');
        $data['checkedandok'] = $this->has('checkedandok');
        $data['checkedandnotok'] = $this->has('checkedandnotok');

        $data['no_info_available'] = $this->has('no_info_available');

        $data['require2'] = $this->has('require2');
        $data['require3'] = $this->has('require3');
        $data['schengen'] = $this->has('schengen');
        $data['supply1'] = $this->has('supply1');
        $data['supply2'] = $this->has('supply2');
        $data['supply3'] = $this->has('supply3');
        $data['supply4'] = $this->has('supply4');

        $data['freedays'] = $this->input('freedays', 0);

        $data['online'] = $this->has('online');
        $data['onarrival'] = $this->has('onarrival');
        $data['foreignrepresentation'] = $this->has('foreignrepresentation');
        $data['noorderinformation'] = $this->has('noorderinformation');

        $data['online_weeks'] = $this->has('online_weeks');
        $data['foreign_weeks'] = $this->has('foreign_weeks');

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
