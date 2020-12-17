<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inooptionchild extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inooptionchildren';

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
        'position',
        'content',
        'contentcode',
        'controlled_at',
        'controlled_user',
        'controlled_ip',
        'created_user',
        'created_ip',
        'updated_user',
        'updated_ip',
    ];

    protected $appends = [
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

    public function languages() {
        return $this->morphToMany(Language::class, 'languageable')->withTimestamps()->withPivot('headline', 'content');
    }

}
