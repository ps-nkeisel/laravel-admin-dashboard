<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pass_condition extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pass_condition';

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
                  'conditionft',
                  'conditionfts',
                  'passport',
                  'passportft',
                  'passportfts',
                  'temppassport',
                  'temppassportft',
                  'temppassportfts',
                  'identitycard',
                  'identitycardft',
                  'identitycardfts',
                  'tempidentitycard',
                  'tempidentitycardft',
                  'tempidentitycardfts',
                  'passportchild',
                  'passportchildft',
                  'passportchildfts',
                  'identitycard2',
                  'identitycard2ft',
                  'identitycard2fts',
                  'creamypassport',
                  'creamypassportft',
                  'creamypassportfts',
                  'cpdeparture',
                  'cptransit',
                  'validity',
                  'validityfts',
                  'validitystopover',
                  'validityentry',
                  'validityexpired',
                  'validitybehindreturn',
                  'validitystay',
                  'latestrequest',
                  'travelinfo',
                  'travelinfofts',
                  'travelwarning',
                  'travelwarningfts',
                  'travelwarning2',
                  'travelwarning2fts',
                  'pregnant',
                  'child',
                  'doublenat',
                  'doublenatfts',
                  'airline',
                  'airlinefts',
                  'underage',
                  'underageowndoc',
                  'underageinfo',
                  'underagefts',
                  'embassyft',
                  'embassyfts',
                  'lostdocumentsfts',
                  'immunisation',
                  'visa',
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
