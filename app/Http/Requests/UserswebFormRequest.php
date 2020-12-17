<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserswebFormRequest extends FormRequest
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
            'idpaymentuser' => 'nullable|numeric',
            'idcontact' => 'nullable|numeric',
            'idsec' => 'nullable|string|max:50',
            'username' => 'nullable|string|max:50',
            'level' => 'required|numeric|min:0|max:999',
            'role' => 'required|string|min:1|max:20',
            'password' => 'nullable|string|max:50',
            'activationpassword' => 'nullable|string|max:50',
            'securequestion' => 'nullable|string|max:255',
            'secureanswer' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:50',
            'realname' => 'nullable|string|max:100',
            'forename' => 'nullable|string|max:50',
            'surname' => 'nullable|string|max:50',
            'address1' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'birthday' => 'nullable|string|max:50',
            'note' => 'nullable|string|max:255',
            'agency' => 'nullable|string|max:20',
            'accounttype' => 'nullable|numeric',
            'feeinstall' => 'nullable|numeric',
            'feemonth' => 'nullable|numeric',
            'feeinterval' => 'nullable|numeric',
            'accessmaxyear' => 'nullable|numeric',
            'access2018' => 'nullable|numeric',
            'access2019' => 'nullable|numeric',
            'access2020' => 'nullable|numeric',
            'access2021' => 'nullable|numeric',
            'access2022' => 'nullable|numeric',
            'testvalidity' => 'nullable|date_format:Y-m-d',
            'testrenewals' => 'nullable|numeric',
            'livefrom' => 'nullable|date_format:Y-m-d',
            'endofuse' => 'nullable|date_format:Y-m-d',
            'canceltype' => 'nullable|numeric',
            'canceldate' => 'nullable|date_format:Y-m-d',
            'linkmaxopen' => 'nullable|numeric',
            'linkmaxtodeparture' => 'nullable|numeric',
            'linkmaxfromcreate' => 'nullable|numeric',
            'clienttype' => 'nullable|numeric',
            'techaccess' => 'nullable|numeric',
            'poa' => 'nullable|numeric',
            'mailable' => 'nullable',
            'usereport' => 'nullable|numeric',
            'visaplaces' => 'required|string|min:1|max:20',
            'showvisaservice' => 'nullable|numeric',
            'showvisaservicelink' => 'nullable|string|max:250',
            'showvisaservicetext' => 'nullable|string|max:1000',
            'info1' => 'nullable|string|max:30',
            'info2' => 'nullable|string|max:30',
            'info3' => 'nullable|string|max:30',
            'info4' => 'nullable|string|max:30',
            'info5' => 'nullable|string|max:30',
            'info6' => 'nullable|string|max:30',
            'remember_token' => 'nullable|string|max:255',
            'favlanguage' => 'nullable|string|max:2',
            'sitelanguage' => 'nullable|string|max:2',
            'logo' => 'nullable|string|max:255',
            'officeNum' => 'nullable|numeric',
            'street' => 'nullable|string|max:255',
            'land' => 'nullable|string|max:10',
            'handy' => 'nullable|string|max:30',
            'fax' => 'nullable|string|max:30',
            'website' => 'nullable|string|max:100',
            'nameAccount' => 'nullable|string|max:100',
            'bank' => 'nullable|string|max:100',
            'theywere' => 'nullable|string|max:50',
            'bic' => 'nullable|string|max:50',
            'ust' => 'nullable|string|max:50',
            'comment' => 'nullable|string|max:255',
            'zohoAccountID' => 'nullable|string|max:100',
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
        $data = $this->only(['assignto', 'idpaymentuser', 'idcontact', 'idsec', 'username', 'level', 'role', 'password', 'activationpassword', 'securequestion', 'secureanswer', 'email', 'realname', 'forename', 'surname', 'address1', 'zip', 'city', 'phone', 'birthday', 'note', 'agency', 'providers', 'accounttype', 'feeinstall', 'feemonth', 'feeinterval', 'accessmaxyear', 'access2018', 'access2019', 'access2020', 'access2021', 'access2022', 'testvalidity', 'testrenewals', 'livefrom', 'endofuse', 'canceltype', 'canceldate', 'linkmaxopen', 'linkmaxtodeparture', 'linkmaxfromcreate', 'clienttype', 'cooperation', 'tags', 'techaccess', 'visaplaces', 'poa', 'usereport', 'showvisaservice', 'showvisaservicelink', 'showvisaservicetext', 'info1', 'info2', 'info3', 'info4', 'info5', 'info6', 'remember_token', 'favdestination', 'favnationality', 'favlanguage', 'sitelanguage', 'logo', 'officeNum', 'street', 'land', 'handy', 'fax', 'website', 'nameAccount', 'bank', 'theywere', 'bic', 'ust', 'comment', 'zohoAccountID', 'providers1']);

        $data['active'] = $this->has('active');
        $data['revised'] = $this->has('revised');
        $data['mailable'] = $this->has('mailable');

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = md5($data['password']);
        }

        return $data;
    }

}
