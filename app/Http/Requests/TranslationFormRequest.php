<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TranslationFormRequest extends FormRequest
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
            'code' => 'required|string|min:1|max:2',
            'namespace' => 'nullable|string',
            'group' => 'nullable|string',
            'item' => 'nullable|string',
            'text' => 'nullable|string',
            'unstable' => 'nullable|boolean',
            'locked' => 'nullable|boolean',
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
        $data = $this->only(['code', 'namespace', 'group', 'item', 'text']);
        $data['unstable'] = $this->has('unstable');
        $data['locked'] = $this->has('locked');

        return $data;
    }

}
