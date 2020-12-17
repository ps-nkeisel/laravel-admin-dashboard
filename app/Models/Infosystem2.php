<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infosystem2 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'infosystems2';

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
        'uuid',
        'info1',
        'info2',
        'info3',
        'info4',
        'entry',
        'visa',
        'transitvisa',
        'health',
        'cruise',
        'corona',
        'country',
        'nat',
        'position',
        'appearance',
        'lang',
        'tagtype',
        'tagtext',
        'tagdate',
        'header',
        'content',
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

    protected $appends = [
        'language_headline',
        'language_content',
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

    public function getLanguageHeadlineAttribute() {
        return $this->languages()->find(2)->pivot->headline ?? '';
    }
    public function getLanguageContentAttribute() {
        return $this->languages()->find(2)->pivot->content ?? '';
    }

    public function createdUser() {
        return $this->belongsTo(User::class, 'created_user');
    }
    public function controlledUser() {
        return $this->belongsTo(User::class, 'controlled_user');
    }

    public function languages() {
        return $this->morphToMany(Language::class, 'languageable')->withTimestamps()
            ->withPivot('headline', 'content', 'id');
    }

}
