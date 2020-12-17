<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infosystem extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'infosystems';

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

    public function language() {
        return $this->belongsTo(Language::class, 'lang');
    }

    public function getLanguageContentAttribute() {
        return $this->language ? $this->language->content : '';
    }

    public function createdUser() {
        return $this->belongsTo(User::class, 'created_user');
    }
    public function controlledUser() {
        return $this->belongsTo(User::class, 'controlled_user');
    }

}
