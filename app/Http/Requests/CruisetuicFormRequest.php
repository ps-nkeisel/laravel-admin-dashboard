<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CruisetuicFormRequest extends FormRequest
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
            // 'assignto' => 'required|numeric',
            // 'idversionbefore' => 'nullable|numeric',
            // 'idversionnext' => 'nullable|numeric',
            // 'version' => 'nullable|numeric',
            // 'idcountry' => 'nullable|numeric',
            'sccode' => 'nullable|string|min:0|max:10',
            'scname' => 'nullable|string|min:0|max:255',
            // 'scname_en' => 'nullable|string|min:0|max:255',
            // 'scname_fr' => 'nullable|string|min:0|max:255',
            // 'scname_it' => 'nullable|string|min:0|max:255',
            // 'scname_nl' => 'nullable|string|min:0|max:255',
            // 'scname_pl' => 'nullable|string|min:0|max:255',
            // 'scname_es' => 'nullable|string|min:0|max:255',
            // 'scname_pt' => 'nullable|string|min:0|max:255',
            // 'scname_be' => 'nullable|string|min:0|max:255',
            // 'scname_ru' => 'nullable|string|min:0|max:255',
            // 'scrcode' => 'nullable|string|min:0|max:1000',
            // 'scrcodeext' => 'nullable|string|min:0|max:1000',
            // 'scrname' => 'nullable|string|min:0|max:255',
            // 'scrname_en' => 'nullable|string|min:0|max:255',
            // 'scrname_fr' => 'nullable|string|min:0|max:255',
            // 'scrname_it' => 'nullable|string|min:0|max:255',
            // 'scrname_nl' => 'nullable|string|min:0|max:255',
            // 'scrname_pl' => 'nullable|string|min:0|max:255',
            // 'scrname_es' => 'nullable|string|min:0|max:255',
            // 'scrname_pt' => 'nullable|string|min:0|max:255',
            // 'scrname_be' => 'nullable|string|min:0|max:255',
            // 'scrname_ru' => 'required|string|min:1|max:255',
            // 'countryfromcode' => 'nullable|string|min:0|max:50',
            'countrytocode' => 'nullable|string|min:0|max:1000',
            // 'routes' => 'required|string|min:1|max:1000',
            // 'countrypassport' => 'nullable|string|min:0|max:1000',
            // 'lettercodefrom' => 'nullable|string|min:0|max:150',
            // 'lettercodeto' => 'nullable|string|min:0|max:2000',
            // 'passport' => 'nullable|numeric',
            // 'temppassport' => 'nullable|numeric',
            // 'identitycard' => 'nullable|numeric',
            // 'tempidentitycard' => 'nullable|numeric',
            // 'passportchild' => 'nullable|numeric',
            // 'validity' => 'nullable|string|min:0|max:4294967295',
            // 'latestrequest' => 'required|numeric',
            // 'travelwarning' => 'nullable|numeric',
            // 'pregnant' => 'nullable|numeric',
            // 'child' => 'nullable|numeric',
            // 'immunisation' => 'nullable|string|min:0|max:4294967295',
            // 'required' => 'nullable|numeric',
            // 'visa' => 'nullable|string|min:0|max:4294967295',
            // 'visa_en' => 'nullable|string|min:0|max:4294967295',
            // 'visa_fr' => 'nullable|string|min:0|max:4294967295',
            // 'visa_it' => 'nullable|string|min:0|max:4294967295',
            // 'visa_nl' => 'nullable|string|min:0|max:4294967295',
            // 'visa_pl' => 'nullable|string|min:0|max:4294967295',
            // 'visa_es' => 'nullable|string|min:0|max:4294967295',
            // 'visa_pt' => 'nullable|string|min:0|max:4294967295',
            // 'visa_be' => 'nullable|string|min:0|max:4294967295',
            // 'visa_ru' => 'nullable|string|min:0|max:4294967295',
            // 'note' => 'nullable|string|min:0|max:255',
            // 'longtext' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_en' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_fr' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_it' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_nl' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_pl' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_es' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_pt' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_be' => 'nullable|string|min:0|max:4294967295',
            // 'longtext_ru' => 'nullable|string|min:0|max:4294967295',
            // 'linkresource' => 'nullable|string|min:0|max:255',
            // 'textresource' => 'nullable|string|min:0|max:4294967295',
            // 'resourcechanged' => 'nullable|numeric',
            // 'status' => 'nullable|numeric',
            // 'importantchange' => 'nullable|numeric',
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
        $data = $this->only(['assignto', 'idversionbefore', 'idversionnext', 'version', 'sccode', 'scname', 'countrytocode']);

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
