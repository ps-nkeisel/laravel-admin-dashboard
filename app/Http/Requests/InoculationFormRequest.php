<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class InoculationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

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
        $data = $this->only(['countrytocode', 'linkresource', 'textresource']);

        $data['active'] = $this->has('active');        $data['archive'] = !$data['active'];
        $data['importantchange'] = $this->has('importantchange');
        $data['checkedandok'] = $this->has('checkedandok');
        $data['checkedandnotok'] = $this->has('checkedandnotok');

        $data['no_info_available'] = $this->has('no_info_available');

        $data['pregnant'] = $this->has('pregnant');
        $data['child'] = $this->has('child');

        $data['yf'] = $this->has('yf');

        if ($data['yf'] && $this->input('yellowfever_id')) {
            $yellowfever_id = $this->input('yellowfever_id');
            if ($yellowfever_id) {
                $data['yellowfever_id'] = $yellowfever_id;
                $data['ggmonth'] = $this->input('ggmonths.'.$yellowfever_id);
                $data['transitingeneral'] = $this->input('transitingenerals.'.$yellowfever_id);
                $data['transittime12hours'] = $this->input('transittime12hours.'.$yellowfever_id);
            }
        } else {
            $data['yellowfever_id'] = 0;
            $data['ggmonth'] = 0;
            $data['transitingeneral'] = 0;
            $data['transittime12hours'] = 0;
        }

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
