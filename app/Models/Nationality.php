<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nationalities';

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
                  'name_de',
                  'name_en',
                  'name_fr',
                  'name_it',
                  'name_nl',
                  'name_pl',
                  'name_es',
                  'name_pt',
                  'name_be',
                  'name_ru',
                  'code',
                  'prio',
                  'created_user',
                  'created_ip',
                  'updated_user',
                  'updated_ip',
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

    public function createdUser() {
        return $this->belongsTo(User::class, 'created_user');
    }
    public function updatedUser() {
        return $this->belongsTo(User::class, 'updated_user');
    }

}
