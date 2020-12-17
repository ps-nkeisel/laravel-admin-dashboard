<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

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
                  'name',
                  'name_local',
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
                  'continent',
                  'capital',
                  'population',
                  'area',
                  'coastline',
                  'governmentform',
                  'currency',
                  'currencycode',
                  'dialingprefix',
                  'birthrate',
                  'deathrate',
                  'lifeexpectancy',
                  'transitvisa',
                  'transitvisatext',
                  'url1',
                  'prio',
                  'google_static_map_code',
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


    public function contentadditionals() {
        return $this->morphMany(Contentadditional::class, 'contentadditionalable')->where('active', 1)->orderBy('position');
    }

    public function xcontentadditionals($data) {
        return $this->contentadditionals()->where('section', $data);
    }

    public static function contentgroups() {
        return Contentgroup::where('contentadditionalable_type', 'LIKE', '%Country%');
    }

    public static function xcontentgroups($data) {
        return Country::contentgroups()->where('section', $data);
    }

    public static function getContentadditionalSectionsArray() {
        $contentadditionalSections = [
            'coli' => [
                'label' => 'Länderinformationen',
                'section' => 'destination_info',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'coai' => [
                'label' => 'Allgemeine Informationen',
                'section' => 'general_info',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'cohe' => [
                'label' => 'Hinweise zur Einreise',
                'section' => 'notes_on_entry',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'cogp' => [
                'label' => 'Gepflogenheiten',
                'section' => 'custom_and_habit',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'comv' => [
                'label' => 'Medizinische Versorgung',
                'section' => 'medical_care',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'coin' => [
                'label' => 'Infrastruktur',
                'section' => 'infrastructure',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'cour' => [
                'label' => 'Umweltbewusstes Reisen',
                'section' => 'ecofriendly_travel',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'corw' => [
                'label' => 'Reisewarnungen / Reisehinweise',
                'section' => 'travel_warning',
                'contentadditionals' => [],
                'contentgroups' => []
            ],
            'cobk' => [
                'label' => 'Botschaften/Konsulate',
                'section' => 'embassies_consulates',
                'contentadditionals' => [],
                'contentgroups' => []
            ]
        ];
        foreach ($contentadditionalSections as $key => $section) {
            $contentadditionalSections[$key]['contentgroups'] = Country::xcontentgroups($section['section'])->get();
        }
        return $contentadditionalSections;
    }

    public function getContentadditionalSectionsData() {
        $contentadditionalSections = Country::getContentadditionalSectionsArray();
        foreach ($contentadditionalSections as $key => $section) {
            $contentadditionalSections[$key]['contentadditionals'] = $this->xcontentadditionals($section['section'])->get();
        }
        return $contentadditionalSections;
    }

}
