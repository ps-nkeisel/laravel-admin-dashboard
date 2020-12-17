<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrypassport extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entrypassports';

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
        'position',
        'content',
        'contentcode',
    ];

    protected $appends = [
        'content_en',
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



    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
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

    public function getContentEnAttribute() {
        return $this->languages()->find(2)->pivot->content ?? '';
    }

    public function getTranslation($language) {
        $languageContent = $this->languages->find($language->id);
        if ($languageContent && !empty($languageContent->pivot->content)) {
            return $languageContent->pivot->content;
        }
        return $this->content;
    }

}
