<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\TransitvisaFormRequest;

class Transitvisa extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transitvisa';

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

                  'countrytocode',
                  'country_id',

                  'no_info_available',
                  'required',
                  'exception',

                  'visa_free',
                  'visa_freedays',

                  'active',
                  'importantchange',
                  'checkedandok',
                  'checkedandnotok',

                  'linkresource',
                  'textresource',

                  'controlled_at',
                  'controlled_user',
                  'controlled_ip',
                  'created_user',
                  'created_ip',
                  'updated_user',
                  'updated_ip',
                  'archive'
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
        return $this->belongsTo(Country::class);
    }

    public function nationalities() {
        return $this->morphToMany(Nationality::class, 'nationalitiable')->withTimestamps()
            ->withPivot('created_user', 'created_ip', 'active', 'archive');
    }

    public function transitvisainfos() {
        return $this->belongsToMany(Transitvisainfo::class, 'transitvisainfoassigns', 'transitvisa_id', 'transitvisainfo_id')->orderBy('position')->withTimestamps()
            ->withPivot('active', 'created_user', 'created_ip', 'archive');
    }


    public function contentadditionals() {
        return $this->morphMany(Contentadditional::class, 'contentadditionalable')->orderBy('position');
    }

    public function required_contentadditionals() {
        return $this->contentadditionals()->where('section', 'req');
    }

    public function eta_contentadditionals() {
        return $this->contentadditionals()->where('section', 'eta');
    }

    public function footer_contentadditionals() {
        return $this->contentadditionals()->where('section', 'fo');
    }


    public static function contentgroups() {
        return Contentgroup::where('contentadditionalable_type', 'LIKE', '%Transitvisa%');
    }

    public static function required_contentgroups() {
        return Visa::contentgroups()->where('section', 'req');
    }

    public static function eta_contentgroups() {
        return Visa::contentgroups()->where('section', 'eta');
    }

    public static function footer_contentgroups() {
        return Visa::contentgroups()->where('section', 'fo');
    }


    public function getReport($language) {
        $title = getContent('headtransitvisa', 'content1', $language->id).' version '.$this->version;

        $report = '<h4>'.getTranslation('transitvisa.h', $language->code).'</h4>';

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('transitvisania', 'content1', $language->id).'</p>';
        } else {
            if ($this->required == 0) {
                $report .= '<p>'.getContent('trv.notrequired', 'content1', $language->id).'</p>';
            } else {
                if ($this->required == 1) {
                    $report .= '<p>'.getContent('trv.required', 'content1', $language->id).'</p>';

                    if($this->exception) {
                        $report .= '<p>'.getContent('trv.req.headline', 'content1', $language->id).'</p>';
                    }

                    $report .= '<ul>';
                    if (count($this->transitvisainfos)) {
                        foreach ($this->transitvisainfos as $transitvisainfo) {
                            $report .= '<li>'.$transitvisainfo->getTranslation($language).'</li>';
                        }
                    }
                    if ($this->visa_free) {
                        $report .= '<li>'.str_replace('%%hours%%', $this->visa_freedays,
                            getContent('trv.vbw', 'content1', $language->id)).'</li>';
                    }
                    if (count($this->required_contentadditionals)) {
                        foreach ($this->required_contentadditionals as $contentadditional) {
                            $languageContent = $contentadditional->languages->find($language->id);
                            if ($languageContent) {
                                $report .= '<li>';
                                $adch = $contentadditional->getHeadline($language);
                                if (isset($adch) && $adch != "") {
                                    $report .= $adch.' ';
                                }
                                $report .= nl2br($languageContent->pivot->content);
                                $report .= '</li>';
                            }
                        }
                    }
                    $report .= '</ul>';
                } else if ($this->required == 2) {
                    $report .= '<p>'.getContent('tv.eta', 'content1', $language->id).'</p>';

                    if($this->exception) {
                        $report .= '<p>'.getContent('trv.eta.headline', 'content1', $language->id).'</p>';
                    }

                    $report .= '<ul>';
                    if (count($this->transitvisainfos)) {
                        foreach ($this->transitvisainfos as $transitvisainfo) {
                            $report .= '<li>'.$transitvisainfo->getTranslation($language).'</li>';
                        }
                    }
                    if ($this->visa_free) {
                        $report .= '<li>'.str_replace('%%hours%%', $this->visa_freedays,
                            getContent('trv.vbw', 'content1', $language->id)).'</li>';
                    }
                    if (count($this->eta_contentadditionals)) {
                        foreach ($this->eta_contentadditionals as $contentadditional) {
                            $languageContent = $contentadditional->languages->find($language->id);
                            if ($languageContent) {
                                $report .= '<li>';
                                $adch = $contentadditional->getHeadline($language);
                                if (isset($adch) && $adch != "") {
                                    $report .= $adch.' ';
                                }
                                $report .= nl2br($languageContent->pivot->content);
                                $report .= '</li>';
                            }
                        }
                    }
                    $report .= '</ul>';
                }
            }

            if (count($this->footer_contentadditionals)) {
                foreach ($this->footer_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<h5>'.$contentadditional->getHeadline($language).'</h5>';
                        $report .= '<p>'.nl2br($languageContent->pivot->content).'</p>';
                    }
                }
            }
        }

        return [
            'title' => $title,
            'content' => $report
        ];
    }

    public function getReport2($language) {
        $title = getContent('headtransitvisa', 'content1', $language->id);

        $report = "";

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('transitvisania', 'content1', $language->id).'</p>';
        } else {
            $this->load('contentadditionals.languages');

            if ($this->required == 0) {
                $report .= '<p>'.getContent('trv.notrequired', 'content1', $language->id).'</p>';
            } else {
                $this->load('transitvisainfos', 'transitvisainfos.languages');

                if ($this->required == 1) {
                    $report .= '<p>'.getContent('trv.required', 'content1', $language->id).'</p>';

                    if($this->exception) {
                        $report .= getContent('trv.req.headline', 'content1', $language->id);
                    }

                    if (count($this->transitvisainfos)) {
                        foreach ($this->transitvisainfos as $transitvisainfo) {
                            $report .= '<br>- '.$transitvisainfo->getTranslation($language);
                        }
                    }

                    if ($this->visa_free) {
                        $report .= '<br>- '.str_replace('%%hours%%', $this->visa_freedays,
                            getContent('trv.vbw', 'content1', $language->id));
                    }

                    $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                        $que->where('language_id', $language->id);
                    }])->where('section', 'req')->get();
                    $report .= $this->formatAcToWeb($contentadditionals, $language);
                } else if ($this->required == 2) {
                    $report .= '<p>'.getContent('tv.eta', 'content1', $language->id).'</p>';

                    if($this->exception) {
                        $report .= '<p>'.getContent('trv.eta.headline', 'content1', $language->id).'</p>';
                    }

                    if (count($this->transitvisainfos)) {
                        foreach ($this->transitvisainfos as $transitvisainfo) {
                            $report .= '<br>- '.$transitvisainfo->getTranslation($language);
                        }
                    }

                    if ($this->visa_free) {
                        $report .= '<br>- '.str_replace('%%hours%%', $this->visa_freedays,
                            getContent('trv.vbw', 'content1', $language->id));
                    }

                    $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                        $que->where('language_id', $language->id);
                    }])->where('section', 'eta')->get();
                    $report .= $this->formatAcToWeb($contentadditionals, $language);
                }
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'fo')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 1, "");
        }

        return [
            'title' => $title,
            'content' => $report
        ];
    }

    public static function getPreview(TransitvisaFormRequest $request, $language) {
        $request_data = $request->getData();

        $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'contentgroups']);

        $title = getContent('headtransitvisa', 'content1', $language->id);

        $preview = '<h4>'.getTranslation('transitvisa.h', $language->code).'</h4>';

        if ($request_data['no_info_available']) {
            $preview .= '<p>'.getContent('transitvisania', 'content1', $language->id).'</p>';
        } else {
            if ($request_data['required'] == 0) {
                $preview .= '<p>'.getContent('trv.notrequired', 'content1', $language->id).'</p>';
            } else {
                if ($request_data['required'] == 1) {
                    $preview .= '<p>'.getContent('trv.required', 'content1', $language->id).'</p>';

                    if ($request_data['exception']) {
                        $preview .= '<p>'.getContent('trv.req.headline', 'content1', $language->id).'</p>';
                    }

                    $preview .= '<ul>';
                    $transitvisainfoParams = $request->getParams(['transitvisainfos']);
                    if (sizeof($transitvisainfoParams['transitvisainfos']) > 0) {
                        foreach ($transitvisainfoParams['transitvisainfos'] as $addinfo_id) {
                            $transitvisainfo = Transitvisainfo::find($addinfo_id);

                            $preview .= '<li>'.$transitvisainfo->getTranslation($language).'</li>';
                        }
                    }
                    if ($request_data['visa_free']) {
                        $preview .= '<li>'.str_replace('%%hours%%', $request_data['visa_freedays'],
                            getContent('trv.vbw', 'content1', $language->id)).'</li>';
                    }
                    foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                        if (($contentadditionalsParam['languageSections'][$position] == 'req') &&
                            (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                            array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                        {
                            $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                            $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                            if (!empty(trim($headline)) || !empty(trim($content))) {
                                if (empty($headline)) {
                                    $contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                                    if ($contentgroup_id) {
                                        $contentgroup = Contentgroup::find($contentgroup_id);
                                        $headline = $contentgroup->getContent($language);
                                    }
                                }
                                $preview .= '<li>';
                                if (!empty(trim($headline))) {
                                    $preview .= '<b>'.$headline.'</b><br>';
                                }
                                if (!empty(trim($content))) {
                                    $preview .= nl2br($content);
                                }
                                $preview .= '</li>';
                            }
                        }
                    }
                    $preview .= '</ul>';
                } else if ($request_data['required'] == 2) {
                    $preview .= '<p>'.getContent('tv.eta', 'content1', $language->id).'</p>';

                    if ($request_data['exception']) {
                        $preview .= '<p>'.getContent('trv.eta.headline', 'content1', $language->id).'</p>';
                    }

                    $preview .= '<ul>';
                    $transitvisainfoParams = $request->getParams(['transitvisainfos']);
                    if (sizeof($transitvisainfoParams['transitvisainfos']) > 0) {
                        foreach ($transitvisainfoParams['transitvisainfos'] as $addinfo_id) {
                            $transitvisainfo = Transitvisainfo::find($addinfo_id);

                            $preview .= '<li>'.$transitvisainfo->getTranslation($language).'</li>';
                        }
                    }
                    if ($request_data['visa_free']) {
                        $preview .= '<li>'.str_replace('%%hours%%', $request_data['visa_freedays'],
                            getContent('trv.vbw', 'content1', $language->id)).'</li>';
                    }
                    foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                        if (($contentadditionalsParam['languageSections'][$position] == 'eta') &&
                            (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                            array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                        {
                            $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                            $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                            if (!empty(trim($headline)) || !empty(trim($content))) {
                                if (empty($headline)) {
                                    $contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                                    if ($contentgroup_id) {
                                        $contentgroup = Contentgroup::find($contentgroup_id);
                                        $headline = $contentgroup->getContent($language);
                                    }
                                }
                                $preview .= '<li>';
                                if (!empty(trim($headline))) {
                                    $preview .= '<b>'.$headline.'</b><br>';
                                }
                                if (!empty(trim($content))) {
                                    $preview .= nl2br($content);
                                }
                                $preview .= '</li>';
                            }
                        }
                    }
                    $preview .= '</ul>';
                }
            }

            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'fo') &&
                    (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                        array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                {
                    $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                    $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                    if (!empty(trim($headline)) || !empty(trim($content))) {
                        if (empty($headline)) {
                            $contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                            if ($contentgroup_id) {
                                $contentgroup = Contentgroup::find($contentgroup_id);
                                $headline = $contentgroup->getContent($language);
                            }
                        }
                        if (!empty(trim($headline))) {
                            $preview .= '<h5>'.$headline.'</h5>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= '<p>'.nl2br($content).'</p>';
                        }
                    }
                }
            }
        }

        return [
            'title' => $title,
            'content' => $preview
        ];
    }

    public function formatAcToWeb($contentadditionals = array(), $language) {
        $returnData = "";
        if(count($contentadditionals) > 0) {
            foreach ($contentadditionals as $contentadditional) {
                $languageContent = $contentadditional->languages->find($language->id);
                if ($languageContent) {
                    $returnData .= '<br>- ';
                    $adch = $contentadditional->getHeadline($language);
                    if (isset($adch) && $adch != "") {
                        $returnData .= $adch.' ';
                    }
                    $returnData .= $languageContent->pivot->content;
                }
            }
        }
        return $returnData;
    }

}
