<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AdrheadFormRequest extends FormRequest
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
            'idcrm' => 'nullable|numeric',
            'idsubscription' => 'nullable|numeric',
            'idsupport' => 'nullable|numeric',
            'idparrent' => 'nullable|numeric',
            'idchild' => 'nullable|numeric',
            'matchcode' => 'nullable|string|max:100',
            'assign_to' => 'nullable|numeric',
            'accountnr' => 'nullable|numeric|string|max:10',
            'birthday' => 'nullable',
            'comment' => 'nullable|string',
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
        $data = $this->only(['idcrm', 'idsubscription', 'idsupport', 'idparrent', 'idchild', 'matchcode',
            'accountnr', 'birthday', 'comment']);

        $data['active'] = $this->has('active');
        $data['deleted'] = $this->has('deleted');

        return $data;
    }

}
