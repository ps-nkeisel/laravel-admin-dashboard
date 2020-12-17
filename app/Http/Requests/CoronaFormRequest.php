<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CoronaFormRequest extends FormRequest
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
            'countrycode' => 'required|string|min:2|max:2'
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
        $data = $this->only([
            'countrycode',
            'kbr_de',
            'kbr_en',
            'kar_de',
            'kar_en',
            'ever_de',
            'ever_en',
            'ebn_de',
            'ebn_en',
            'ge_de',
            'ge_en',
            'kes_de',
            'kes_en',
            'slu_de',
            'slu_en',
            'sla_de',
            'sla_en',
            'sse_de',
            'sse_en',
            'gla_de',
            'gla_en',
            'fla_de',
            'fla_en',
            'not_de',
            'not_en',
            'eol_de',
            'eol_en',
            'vre_de',
            'vre_en'
        ]);
        $data['active'] = $this->has('active') ? 1 : 0;

        return $data;
    }

}
