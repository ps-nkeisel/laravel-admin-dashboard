<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pass_visa extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pass_visa';

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
                  'idversionbefore',
                  'idversionnext',
                  'version',
                  'idcountry',
                  'countryfromcode',
                  'countrytocode',
                  'countrypassport',
                  'lettercodefrom',
                  'lettercodeto',
                  'passport',
                  'temppassport',
                  'identitycard',
                  'tempidentitycard',
                  'passportchild',
                  'validity',
                  'latestrequest',
                  'travelwarning',
                  'pregnant',
                  'child',
                  'immunisation',
                  'required',
                  'usevisa',
                  'visa',
                  'visa_en',
                  'visa_fr',
                  'visa_it',
                  'visa_nl',
                  'visa_pl',
                  'visa_es',
                  'visa_pt',
                  'visa_be',
                  'visa_ru',
                  'visa1',
                  'visa1_en',
                  'visa1_fr',
                  'visa1_it',
                  'visa1_nl',
                  'visa1_pl',
                  'visa1_es',
                  'visa1_pt',
                  'visa1_be',
                  'visa1_ru',
                  'note',
                  'longtext',
                  'longtext_en',
                  'longtext_fr',
                  'longtext_it',
                  'longtext_nl',
                  'longtext_pl',
                  'longtext_es',
                  'longtext_pt',
                  'longtext_be',
                  'longtext_ru',
                  'linkresource',
                  'textresource',
                  'resourcechanged',
                  'status',
                  'importantchange',
                  'controlled_at',
                  'controlled_user',
                  'controlled_ip',
                  'created_user',
                  'created_ip',
                  'updated_user',
                  'updated_ip',
                  'archive',
                  'active'
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
    protected $casts = [];


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

}
