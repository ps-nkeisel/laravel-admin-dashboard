<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contentadditional extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contentadditionals';

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
    ];

    protected $appends = [
        'headline',
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

    public function contentadditionalable()
    {
        return $this->morphTo();
    }

    public function languages() {
        return $this->morphToMany(Language::class, 'languageable')->withTimestamps()
            ->withPivot('headline', 'content', 'id', 'main',
                'agencyexport', 'agencytranslated', 'agencyimport', 'translated', 'translatedfrom'
            );
    }

    public function getHeadlineAttribute() {
        return $this->languages()->find(2)->pivot->headline ?? '';
    }

    public function contentgroup() {
        return $this->belongsTo(Contentgroup::class, 'contentgroup_id');
    }

    public function getHeadline($language) {
        $languageContent = $this->languages->find($language->id);
        if ($languageContent) {
            if (!empty($languageContent->pivot->headline)) {
                return $languageContent->pivot->headline;
            } else if ($this->contentgroup) {
                return $this->contentgroup->getContent($language);
            }
        }
        return '';
    }

}
