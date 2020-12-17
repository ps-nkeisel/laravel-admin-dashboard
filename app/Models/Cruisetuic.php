<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Requests\CruisetuicFormRequest;

class Cruisetuic extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pass_cruisevisa';

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
                  'sccode',
                  'scname',
                //   'scname_en',
                //   'scname_fr',
                //   'scname_it',
                //   'scname_nl',
                //   'scname_pl',
                //   'scname_es',
                //   'scname_pt',
                //   'scname_be',
                //   'scname_ru',
                //   'scrcode',
                //   'scrcodeext',
                //   'scrname',
                //   'scrname_en',
                //   'scrname_fr',
                //   'scrname_it',
                //   'scrname_nl',
                //   'scrname_pl',
                //   'scrname_es',
                //   'scrname_pt',
                //   'scrname_be',
                //   'scrname_ru',
                //   'countryfromcode',
                  'countrytocode',
                //   'routes',
                //   'countrypassport',
                //   'lettercodefrom',
                //   'lettercodeto',
                //   'passport',
                //   'temppassport',
                //   'identitycard',
                //   'tempidentitycard',
                //   'passportchild',
                //   'validity',
                //   'latestrequest',
                //   'travelwarning',
                //   'pregnant',
                //   'child',
                //   'immunisation',
                //   'required',
                //   'visa',
                //   'visa_en',
                //   'visa_fr',
                //   'visa_it',
                //   'visa_nl',
                //   'visa_pl',
                //   'visa_es',
                //   'visa_pt',
                //   'visa_be',
                //   'visa_ru',
                //   'note',
                //   'longtext',
                //   'longtext_en',
                //   'longtext_fr',
                //   'longtext_it',
                //   'longtext_nl',
                //   'longtext_pl',
                //   'longtext_es',
                //   'longtext_pt',
                //   'longtext_be',
                //   'longtext_ru',
                //   'linkresource',
                //   'textresource',
                //   'resourcechanged',
                //   'status',
                'importantchange',
                'checkedandok',
                'checkedandnotok',

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
                'created_username',
                'updated_username',
                'controlled_username',
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
    public function getCreatedUsernameAttribute() {
        return $this->createdUser ? $this->createdUser->name : '';
    }

    public function updatedUser() {
        return $this->belongsTo(User::class, 'updated_user');
    }
    public function getUpdatedUsernameAttribute() {
        return $this->updatedUser ? $this->updatedUser->name : '';
    }

    public function controlledUser() {
        return $this->belongsTo(User::class, 'controlled_user');
    }
    public function getControlledUsernameAttribute() {
        return $this->controlledUser ? $this->controlledUser->name : '';
    }


    public function country() {
        return $this->belongsTo(Country::class, 'idcountry');
    }

    public function nationalities() {
        return $this->morphToMany(Nationality::class, 'nationalitiable')->withTimestamps()->withPivot('created_user', 'created_ip', 'active', 'archive');
    }


    public function contentadditionals() {
        return $this->morphMany(Contentadditional::class, 'contentadditionalable')->orderBy('position');
    }

    public static function contentgroups() {
        return Contentgroup::where('contentadditionalable_type', 'CruiseTUIC')->where('position', '>=', 10)->orderBy('position');
    }

    public static function visa_contentgroups() {
        return Cruisetuic::contentgroups()->where('position', '<=', 19);
    }

    public static function inoculation_contentgroups() {
        return Cruisetuic::contentgroups()->where('position', '>=', 20)->where('position', '<=', 29);
    }

    public function getContentEntry($language) {
        $headline = '<h4>Allgemeine Einreisebestimmungen</h4>';

        $content = getContent('tuic.allg', 'content1', $language->id).'<br><br>';
        $content .= '<b>'.getContent('tuic.doc', 'text1', $language->id).'</b><br>';
        $content .= getContent('tuic.doc', 'content1', $language->id).'<br><br>';
        $content .= '<b>'.getContent('tuic.min', 'text1', $language->id).'</b><br>';
        $content .= getContent('tuic.min', 'content1', $language->id).'<br><br>';

        return [
            'headline' => $headline,
            'content' => $content
        ];
    }

    public function getContentVisa($language) {
        $headline = '<h4>Länderspezifische Informationen zur Einreise</h4>';
        $content = '';

        $contentgroups = Cruisetuic::visa_contentgroups()->get();
        foreach ($contentgroups as $contentgroup) {
            $contentadditionals = $this->contentadditionals->where('contentgroup_id', $contentgroup->id);
            if (count($contentadditionals) > 0) {
                foreach ($contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $content .= '<b>'.$contentadditional->getHeadline($language).'</b>';
                        $content .= '<p>'.nl2br($languageContent->pivot->content).'</p>';
                    }
                }
            }
        }

        return [
            'headline' => $headline,
            'content' => $content
        ];
    }

    public function getContentInoculation($language) {
        $headline = '<h4>Gesundheitliche Hinweise</h4>';
        $content = '';

        $contentgroups = Cruisetuic::inoculation_contentgroups()->get();
        foreach ($contentgroups as $contentgroup) {
            $contentadditionals = $this->contentadditionals->where('contentgroup_id', $contentgroup->id);
            if (count($contentadditionals) > 0) {
                foreach ($contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $content .= '<p>'.nl2br($languageContent->pivot->content).'</p>';
                    }
                }
            }
        }

        return [
            'headline' => $headline,
            'content' => $content
        ];
    }

    public function getReport($language) {
        $title = getContent('headcruisetuic', 'content1', $language->id).' version '.$this->version;

        //$report = '<h4>'.getTranslation('cruisetuic.h', $language->code).'</h4>';
        $report = '';

        //entry datas
        $entry_data = $this->getContentEntry($language);
        $report .= $entry_data['headline'] . $entry_data['content'];

        $report .= '<br>';
        //visa datas
        $visa_data = $this->getContentVisa($language);
        $report .= $visa_data['headline'] . $visa_data['content'];

        $report .= '<br>';
        //inoculation datas
        $inoculation_data = $this->getContentInoculation($language);
        $report .= $inoculation_data['headline'] . $inoculation_data['content'];

        return [
            'title' => $title,
            'content' => $report
        ];
    }

    public static function getPreview(CruisetuicFormRequest $request, $language) {
        $request_data = $request->getData();

        $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'contentgroups']);

        $title = getContent('headcruisetuic', 'content1', $language->id);

        $preview = '<h4>'.getTranslation('cruisetuic.h', $language->code).'</h4>';

        $contentgroups = Cruisetuic::contentgroups()->get();
        foreach ($contentgroups as $contentgroup) {
            $conadd_count = 0;

            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['contentgroups'][$position] == $contentgroup->id) &&
                    (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                    array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                {
                    if ($conadd_count == 0) {
                        $preview .= '<h4>'.$contentgroup->content.'</h4>';
                    }
                    $conadd_count ++;

                    $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                    $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                    if (!empty(trim($headline)) || !empty(trim($content))) {
                        $preview .= '<h5>'.$headline.'</h5>';
                        $preview .= '<p>'.nl2br($content).'</p>';
                    }
                }
            }
        }

        return [
            'title' => $title,
            'content' => $preview
        ];
    }

}
