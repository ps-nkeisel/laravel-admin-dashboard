<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usersweb extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usersweb';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'assignto',
                  'idpaymentuser',
                  'idcontact',
                  'revised',
                  'idsec',
                  'username',
                  'level',
                  'role',
                  'password',
                  'activationpassword',
                  'securequestion',
                  'secureanswer',
                  'email',
                  'realname',
                  'forename',
                  'surname',
                  'address1',
                  'zip',
                  'city',
                  'phone',
                  'birthday',
                  'note',
                  'agency',
                  'providers',
                  'accounttype',
                  'feeinstall',
                  'feemonth',
                  'feeinterval',
                  'accessmaxyear',
                  'access2018',
                  'access2019',
                  'access2020',
                  'access2021',
                  'access2022',
                  'testvalidity',
                  'testrenewals',
                  'livefrom',
                  'endofuse',
                  'canceltype',
                  'canceldate',
                  'linkmaxopen',
                  'linkmaxtodeparture',
                  'linkmaxfromcreate',
                  'clienttype',
                  'cooperation',
                  'tags',
                  'techaccess',
                  'poa',
                  'mailable',
                  'usereport',
                  'visaplaces',
                  'showvisaservice',
                  'showvisaservicelink',
                  'showvisaservicetext',
                  'info1',
                  'info2',
                  'info3',
                  'info4',
                  'info5',
                  'info6',
                  'remember_token',
                  'favdestination',
                  'favnationality',
                  'favlanguage',
                  'sitelanguage',
                  'logo',
                  'officeNum',
                  'street',
                  'land',
                  'handy',
                  'fax',
                  'website',
                  'nameAccount',
                  'bank',
                  'theywere',
                  'bic',
                  'ust',
                  'comment',
                  'zohoAccountID',

                  'created_user',
                  'created_ip',
                  'updated_user',
                  'updated_ip',
                  'providers1',

                  'active',
                ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'providers' => 'json',
        'providers1' => 'json',
        'cooperation' => 'json',
        'favdestination' => 'json',
        'favnationality' => 'json',
        'tags' => 'json',
    ];


    public function getTestvalidityAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function getLivefromAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function getEndofuseAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function getCanceldateAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function getCreatedAtAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function getUpdatedAtAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function createdUser() {
        return $this->belongsTo(User::class, 'created_user');
    }
    public function getCreatedUsernameAttribute() {
        return $this->createdUser ? $this->createdUser->name : '';
    }

    public function updatedUser() {
        return $this->belongsTo(User::class, 'updated_user');
    }
    public function getUpdatedUsernameAttribute() {
        return $this->updatedUser ? $this->updatedUser->name : '';
    }

}
