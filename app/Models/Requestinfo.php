<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestinfo extends Model
{
    protected $connection = 'mysql2';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requests';

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
                  'userid',
                  'requestid',
                  'dest',
                  'nat',
                  'lang',
                  'bookingnr',
                  'traveldate',
                  'checkimportant',
                ];

    protected $appends = [
                'username',
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


    public function user() {
        return $this->setConnection('mysql')->belongsTo(User::class, 'userid');
    }
    public function getUsernameAttribute() {
        return $this->user ? $this->user->name : '';
    }

    public function getCreatedAtAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

}
