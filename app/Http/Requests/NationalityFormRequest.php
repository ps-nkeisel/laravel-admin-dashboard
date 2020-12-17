<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class NationalityFormRequest extends FormRequest
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
            'name_de' => 'nullable|string|min:0|max:150',
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
            'prio' => 'nullable|numeric|min:0|max:2147483647',
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
        $data = $this->only(['name_de', 'name_en', 'name_fr', 'name_it', 'name_nl', 'name_pl', 'name_es', 'name_pt', 'name_be', 'name_ru', 'code', 'prio']);
        $data['active'] = $this->has('active') ? 1 : 0;

        return $data;
    }

}
