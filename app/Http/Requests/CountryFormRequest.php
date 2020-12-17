<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CountryFormRequest extends FormRequest
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
            'name' => 'nullable|string|min:0|max:150',
            'name_local' => 'nullable|string|min:0|max:150',
            'name_en' => 'nullable|string|min:0|max:150',
            'name_fr' => 'nullable|string|min:0|max:150',
            'name_it' => 'nullable|string|min:0|max:150',
            'name_nl' => 'nullable|string|min:0|max:150',
            'name_pl' => 'nullable|string|min:0|max:150',
            'name_es' => 'nullable|string|min:0|max:150',
            'name_pt' => 'nullable|string|min:0|max:150',
            'name_be' => 'nullable|string|min:0|max:150',
            'name_ru' => 'nullable|string|min:0|max:150',
            'code' => 'nullable|string|min:0|max:2',
            'continent' => 'nullable|string|min:0|max:50',
            'capital' => 'nullable|string|min:0|max:50',
            'population' => 'nullable|string|min:0|max:20',
            'area' => 'nullable|string|min:0|max:20',
            'coastline' => 'nullable|string|min:0|max:10',
            'governmentform' => 'nullable|string|min:0|max:200',
            'currency' => 'nullable|string|min:0|max:10',
            'currencycode' => 'nullable|string|min:0|max:10',
            'dialingprefix' => 'nullable|string|min:0|max:10',
            'birthrate' => 'nullable|string|min:0|max:10',
            'deathrate' => 'nullable|string|min:0|max:10',
            'lifeexpectancy' => 'nullable|string|min:0|max:10',
            'transitvisa' => 'nullable|numeric|min:0|max:2147483647',
            'transitvisatext' => 'nullable|string|min:0|max:4294967295',
            'url1' => 'nullable|string|min:0|max:255',
            'prio' => 'nullable|numeric|min:0|max:2147483647',
            'google_static_map_code' => 'nullable|string|min:0',
            'active' => 'nullable|numeric|min:0',
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
        $data = $this->only(['name', 'name_local', 'name_en', 'name_fr', 'name_it', 'name_nl', 'name_pl', 'name_es', 'name_pt', 'name_be', 'name_ru', 'code', 'continent', 'capital', 'population', 'area', 'coastline', 'governmentform', 'currency', 'currencycode', 'dialingprefix', 'birthrate', 'deathrate', 'lifeexpectancy', 'transitvisa', 'transitvisatext', 'url1', 'prio', 'google_static_map_code', 'active']);
        $data['active'] = $this->has('active') ? 1 : 0;

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
