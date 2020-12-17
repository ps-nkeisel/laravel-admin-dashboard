<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Language;
use App\Http\Requests\InoculationFormRequest;

class Inoculation extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inoculations';

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

        'active',
        'importantchange',
        'checkedandok',
        'checkedandnotok',

        'countrytocode',
        'country_id',

        'no_info_available',

        'pregnant',
        'child',
        'yf',

        'yellowfever_id',
        'ggmonth',
        'transitingeneral',
        'transittime12hours',

        'linkresource',
        'textresource',

        'controlled_at',
        'controlled_user',
        'controlled_ip',
        'controlled_at',
        'controlled_user',
        'controlled_ip',
        'created_user',
        'created_ip',
        'updated_user',
        'updated_ip',
        'archive',
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


    public function getControlledAtAttribute($value)
    {
        $result = \DateTime::createFromFormat($this->getDateFormat(), $value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

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

    public function requirement_immunisations() {
        return $this->belongsToMany(Immunisation::class, 'inoimmumatch', 'inoculation_id', 'requirement_immunisation_id')->orderBy('position')->withTimestamps()
            ->withPivot('version', 'longtermstay', 'specialexposure', 'active', 'archive', 'created_user', 'created_ip');
    }

    public function recommendation_immunisations() {
        return $this->belongsToMany(Immunisation::class, 'inoimmumatch', 'inoculation_id', 'recommendation_immunisation_id')->orderBy('position')->withTimestamps()
            ->withPivot('version', 'longtermstay', 'specialexposure', 'active', 'archive', 'created_user', 'created_ip');
    }

    public function optionpregnants() {
        return $this->belongsToMany(Inooptionpregnant::class, 'inooptpregmatch', 'inoculation_id', 'inooptionpregnant_id')->orderBy('position')->withTimestamps()
            ->withPivot('version', 'active', 'archive', 'created_user', 'created_ip');
    }

    public function optionchildren() {
        return $this->belongsToMany(Inooptionchild::class, 'inooptchildmatch', 'inoculation_id', 'inooptionchild_id')->orderBy('position')->withTimestamps()
            ->withPivot('version', 'active', 'archive', 'created_user', 'created_ip');
    }

    public function yellowfever() {
        return $this->belongsTo(Yellowfever::class, 'yellowfever_id');
    }

    public function inoculationspecifics() {
        return $this->belongsToMany(Inoculationspecific::class, 'inooptspecmatch', 'inoculation_id', 'inoculationspecific_id')->orderBy('position')->withTimestamps()
            ->withPivot('version', 'active', 'archive', 'created_user', 'created_ip');
    }


    public function contentadditionals() {
        return $this->morphMany(Contentadditional::class, 'contentadditionalable')->orderBy('position');
    }

    public function pregnant_contentadditionals() {
        return $this->contentadditionals()->where('section', 'op');
    }

    public function child_contentadditionals() {
        return $this->contentadditionals()->where('section', 'oc');
    }

    public function yellowfever_contentadditionals() {
        return $this->contentadditionals()->where('section', 'yf');
    }

    public function specific_contentadditionals() {
        return $this->contentadditionals()->where('section', 'sp');
    }

    public function footer_contentadditionals() {
        return $this->contentadditionals()->where('section', 'fo');
    }

    public static function contentgroups() {
        return Contentgroup::where('contentadditionalable_type', 'LIKE', '%Inoculation%');
    }

    public static function pregnant_contentgroups() {
        return Inoculation::contentgroups()->where('section', 'op');
    }

    public static function child_contentgroups() {
        return Inoculation::contentgroups()->where('section', 'oc');
    }

    public static function yellowfever_contentgroups() {
        return Inoculation::contentgroups()->where('section', 'yf');
    }

    public static function specific_contentgroups() {
        return Inoculation::contentgroups()->where('section', 'sp');
    }

    public static function footer_contentgroups() {
        return Inoculation::contentgroups()->where('section', 'fo');
    }


    public function getReport($language) {
        $title = getContent('headhealth', 'content1', $language->id).' version '.$this->version;

        $report = '<h3>'.getTranslation('health.h', $language->code).'</h3>';

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('healthnia', 'content1', $language->id).'</p>';
        } else {
            $trans_hr_ltsse = getTranslation('hr.ltsse', $language->code);
            $trans_hr_lts = getTranslation('hr.lts', $language->code);
            $trans_hr_se = getTranslation('hr.se', $language->code);
            $active_requirement_immunisations = $this->requirement_immunisations()->wherePivot('requirement_immunisation_id', '>', 0)->wherePivot('active', 1)->orderBy('position', 'asc')->get();
            if (sizeof($active_requirement_immunisations) == 0) {
                $report .= '<h4>'.getContent('nohreq', 'content1', $language->id).'</h4>';
            } else {
                $report .= '<h4>'.getContent('healthreq', 'content1', $language->id).'</h4>';
                $report .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                foreach ($active_requirement_immunisations as $immunisation) {
                    $report .= '<li>'.($immunisation->languages->find($language->id)->pivot->content ?? $immunisation->content);

                    if ($immunisation->pivot->longtermstay && $immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_ltsse;
                    } else if ($immunisation->pivot->longtermstay) {
                        $report .= ', '.$trans_hr_lts;
                    } else if ($immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_se;
                    }

                    $report .= '</li>';
                }
                $report .= '</ul>';
            }

            $active_recommendation_immunisations = $this->recommendation_immunisations()->wherePivot('recommendation_immunisation_id', '>', 0)->wherePivot('active', 1)->orderBy('position', 'asc')->get();
            if (sizeof($active_recommendation_immunisations) == 0) {
                $report .= '<h4>'.getContent('nohrec', 'content1', $language->id).'</h4>';
            } else {
                $report .= '<h4>'.getContent('healthrec', 'content1', $language->id).'</h4>';
                $report .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                foreach ($active_recommendation_immunisations as $immunisation) {
                    $report .= '<li>'.($immunisation->languages->find($language->id)->pivot->content ?? $immunisation->content);

                    if ($immunisation->pivot->longtermstay && $immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_ltsse;
                    } else if ($immunisation->pivot->longtermstay) {
                        $report .= ', '.$trans_hr_lts;
                    } else if ($immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_se;
                    }

                    $report .= '</li>';
                }
                $report .= '</ul>';
            }

            $report .= '<br>';

            $specifics = $this->inoculationspecifics()->wherePivot('active', 1)->orderBy('position', 'asc')->get();
            foreach ($specifics as $specific) {
                $report .= '<h4>'.getContent($specific->contentcode, 'text1', $language->id).'</h4>';
                $report .= '<p>'.getContent($specific->contentcode, 'content1', $language->id).'</p>';
            }
            if (count($this->specific_contentadditionals)) {
                foreach ($this->specific_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if ($this->pregnant) {
                $report .= '<h4>'.getContent('headpreg', 'text1', $language->id).'</h4>';
                $report .= '<p>'.getContent('headpreg', 'content1', $language->id).'</p>';

                $report .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                $optionpregnants = $this->optionpregnants()->wherePivot('active', 1)->get();
                foreach ($optionpregnants as $pregnant) {
                    $report .= '<li>'.($pregnant->languages->find($language->id)->pivot->content ?? $pregnant->content).'</li>';
                }
                $report .= '</ul>';
            }
            if (count($this->pregnant_contentadditionals)) {
                foreach ($this->pregnant_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }
            if ($this->child) {
                $report .= '<h4>'.getContent('headchild', 'text1', $language->id).'</h4>';
                $report .= '<p>'.getContent('headchild', 'content1', $language->id).'</p>';

                $report .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                $optionchildren = $this->optionchildren()->wherePivot('active', 1)->get();
                foreach ($optionchildren as $child) {
                    $report .= '<li>'.($child->languages->find($language->id)->pivot->content ?? $child->content).'</li>';
                }
                $report .= '</ul>';
            }
            if (count($this->child_contentadditionals)) {
                foreach ($this->child_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if ($this->yf && isset($this->yellowfever)) {
                $yellowfever = $this->yellowfever;
                if ($yellowfever->id == 1) {    // risk countries
                    $report .= '<h4>'.getContent('yfinfection', 'text1', $language->id).'</h4>';
                    $report .= '<p>'.getContent('yfinfection', 'content1', $language->id).'</p>';

                    if($this->ggmonth) {
                        $report .= str_replace("%%Age%%", $this->ggmonth,
                            getContent('yfage', 'content1', $language->id));
                    }
                    if($this->transitingeneral) {
                        $report .= getContent('yftransit', 'content1', $language->id);
                    }
                    if($this->transittime12hours) {
                        $report .= getContent('yftransittwelve', 'content1', $language->id);
                    }

                    $report .= '<h4>'.getContent('yfcountries', 'text1', $language->id).'</h4>';
                    $report .= '<p>'.getContent('yfcountries', 'content1', $language->id).'</p>';
                } else if ($yellowfever->id == 2) {    // all countries
                    $report .= '<h4>'.getContent('yfall', 'text1', $language->id).'</h4>';
                    $report .= '<p>'.getContent('yfall', 'content1', $language->id).'</p>';

                    if ($this->ggmonth) {
                        $report .= str_replace("%%Age%%", $this->ggmonth,
                            getContent('yfage', 'content1', $language->id));
                    }

                    if ($this->transitingeneral) {
                        $report .= getContent('yftransit', 'content1', $language->id);
                    }
                    if ($this->transittime12hours) {
                        $report .= getContent('yftransittwelve', 'content1', $language->id);
                    }
                }
            }
            if (count($this->yellowfever_contentadditionals)) {
                foreach ($this->yellowfever_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if (count($this->footer_contentadditionals)) {
                foreach ($this->footer_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }
        }

        return [
            'title' => $title,
            'content' => $report
        ];
    }

    public function getReport2($language) {
        $title = getContent('headhealth', 'content1', $language->id);

        $report = "";

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('healthnia', 'content1', $language->id).'</p><br>';
        } else {
            $this->load('contentadditionals.languages');
            $trans_hr_ltsse = getTranslation('hr.ltsse', $language->code);
            $trans_hr_lts = getTranslation('hr.lts', $language->code);
            $trans_hr_se = getTranslation('hr.se', $language->code);

            $active_requirement_immunisations = $this->requirement_immunisations()->wherePivot('requirement_immunisation_id', '>', 0)->wherePivot('active', 1)->orderBy('position', 'asc')->get();
            if (sizeof($active_requirement_immunisations) == 0) {
                $report .= getContent('nohreq', 'content1', $language->id).'<br><br>';
            } else {
                $active_requirement_immunisations->load('languages');
                $report .= '<b>'.getContent('healthreq', 'content1', $language->id).'</b><br>';
                foreach ($active_requirement_immunisations as $immunisation) {
                    $report .= '- '.($immunisation->languages->find($language->id)->pivot->content ?? $immunisation->content);

                    if ($immunisation->pivot->longtermstay && $immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_ltsse;
                    } else if ($immunisation->pivot->longtermstay) {
                        $report .= ', '.$trans_hr_lts;
                    } else if ($immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_se;
                    }
                    $report .= '<br>';
                }
            }

            $active_recommendation_immunisations = $this->recommendation_immunisations()->wherePivot('recommendation_immunisation_id', '>', 0)->wherePivot('active', 1)->orderBy('position', 'asc')->get();
            if (sizeof($active_recommendation_immunisations) == 0) {
                $report .= getContent('nohrec', 'content1', $language->id).'<br>';
            } else {
                $active_recommendation_immunisations->load('languages');
                $report .= '<br><b>'.getContent('healthrec', 'content1', $language->id).'</b><br>';
                foreach ($active_recommendation_immunisations as $immunisation) {
                    $report .= '- '.($immunisation->languages->find($language->id)->pivot->content ?? $immunisation->content);

                    if ($immunisation->pivot->longtermstay && $immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_ltsse;
                    } else if ($immunisation->pivot->longtermstay) {
                        $report .= ', '.$trans_hr_lts;
                    } else if ($immunisation->pivot->specialexposure) {
                        $report .= ', '.$trans_hr_se;
                    }
                    $report .= '<br>';
                }
            }

            $specifics = $this->inoculationspecifics()->wherePivot('active', 1)->orderBy('position', 'asc')->get();
            foreach ($specifics as $specific) {
                $report .= '<br><b>'.getContent($specific->contentcode, 'text1', $language->id).'</b><br>';
                $report .= '<p>'.getContent($specific->contentcode, 'content1', $language->id).'</p>';
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'sp')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 0, "");

            if ($this->pregnant) {
                $report .= '<br><br><b>'.getContent('headpreg', 'text1', $language->id).'</b>';
                $report .= '<br><p>'.getContent('headpreg', 'content1', $language->id).'</p>';

                $optionpregnants = $this->optionpregnants()->wherePivot('active', 1)->get();
                $optionpregnants->load('languages');
                foreach ($optionpregnants as $key => $pregnant) {
                    if ($key > 0) {
                        $report .= '<br>';
                    }
                    $report .= '- '.($pregnant->languages->find($language->id)->pivot->content ?? $pregnant->content);
                }
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'op')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 0, "");

            if ($this->child) {
                $report .= '<br><br><b>'.getContent('headchild', 'text1', $language->id).'</b>';
                $report .= '<br><p>'.getContent('headchild', 'content1', $language->id).'</p>';

                $optionchildren = $this->optionchildren()->wherePivot('active', 1)->get();
                $optionchildren->load('languages');
                foreach ($optionchildren as $key => $child) {
                    if ($key > 0) {
                        $report .= '<br>';
                    }
                    $report .= '- '.($child->languages->find($language->id)->pivot->content ?? $child->content);
                }
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'oc')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 0, "");

            if ($this->yf) {
                $yellowfever = $this->yellowfever;

                if (isset($yellowfever) && $yellowfever->id == 1) {    // risk countries
                    $report .= '<br><br><b>'.getContent('yfinfection', 'text1', $language->id).'</b><br>';
                    $report .= '<p>'.getContent('yfinfection', 'content1', $language->id).'</p>';

                    if($this->ggmonth) {
                        $report .= str_replace("%%Age%%", $this->ggmonth,
                            getContent('yfage', 'content1', $language->id)) ." ";
                    }
                    if($this->transitingeneral) {
                        $report .= getContent('yftransit', 'content1', $language->id) ." ";
                    }
                    if($this->transittime12hours) {
                        $report .= getContent('yftransittwelve', 'content1', $language->id) ." ";
                    }
                } else if (isset($yellowfever) && $yellowfever->id == 2) {    // all countries
                    $report .= '<br><br><b>'.getContent('yfall', 'text1', $language->id).'</b><br>';
                    $report .= '<p>'.getContent('yfall', 'content1', $language->id).'</p>';

                    if ($this->ggmonth) {
                        $report .= str_replace("%%Age%%", $this->ggmonth,
                            getContent('yfage', 'content1', $language->id));
                    }
                    if ($this->transitingeneral) {
                        $report .= getContent('yftransit', 'content1', $language->id);
                    }
                    if ($this->transittime12hours) {
                        $report .= getContent('yftransittwelve', 'content1', $language->id);
                    }
                }

                $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                    $que->where('language_id', $language->id);
                }])->where('section', 'yf')->get();
                $report .= formatAcToWeb($contentadditionals, $language, 1, "");

                if (isset($yellowfever) && $yellowfever->id == 1) {    // risk countries
                    $report .= '<br><br><b>'.getContent('yfcountries', 'text1', $language->id).'</b><br>';
                    $report .= '<p>'.getContent('yfcountries', 'content1', $language->id).'</p>';
                }
            }
            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'fo')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 0, "");
        }

        $footerHeadline = getContent('end.1', 'text1', $language->id);
        if (isset($footerHeadline) && $footerHeadline != "") {
            $report .= "<br><br>". $footerHeadline ."<br>";
        }
        $footerContent = getContent('end.1', 'content1', $language->id);
        $report .= $footerContent;


        return [
            'title' => $title,
            'content' => $report
        ];
    }

    public static function getPreview(InoculationFormRequest $request, $language) {
        $request_data = $request->getData();

        $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'contentgroups']);

        $title = getContent('headhealth', 'content1', $language->id);

        $preview = '<h3>'.getTranslation('health.h', $language->code).'</h3>';

        if ($request_data['no_info_available']) {
            $preview .= '<p>'.getContent('healthnia', 'content1', $language->id).'</p>';
        } else {
            $trans_hr_ltsse = getTranslation('hr.ltsse', $language->code);
            $trans_hr_lts = getTranslation('hr.lts', $language->code);
            $trans_hr_se = getTranslation('hr.se', $language->code);

            $reqImmunParams = $request->getParams(['requirement_immunisations', 'requirement_longtermstays', 'requirement_specialexposures']);
            if (sizeof($reqImmunParams['requirement_immunisations']) == 0) {
                $preview .= '<h4>'.getContent('nohreq', 'content1', $language->id).'</h4>';
            } else {
                $preview .= '<h4>'.getContent('healthreq', 'content1', $language->id).'</h4>';
                $preview .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                foreach ($reqImmunParams['requirement_immunisations'] as $immun_id) {
                    $immunisation = Immunisation::find($immun_id);
                    $longtermstay = array_search($immunisation->id, $reqImmunParams['requirement_longtermstays']) !== false ? true : false;
                    $specialexposure = array_search($immunisation->id, $reqImmunParams['requirement_specialexposures']) !== false ? true : false;

                    if ($immunisation) {
                        $preview .= '<li>'.($immunisation->languages->find($language->id)->pivot->content ?? $immunisation->content);

                        if ($longtermstay && $specialexposure) {
                            $preview .= ', '.$trans_hr_ltsse;
                        } else if ($longtermstay) {
                            $preview .= ', '.$trans_hr_lts;
                        } else if ($specialexposure) {
                            $preview .= ', '.$trans_hr_se;
                        }

                        $preview .= '</li>';
                    }
                }
                $preview .= '</ul>';
            }

            $recImmunParams = $request->getParams(['recommendation_immunisations', 'recommendation_longtermstays', 'recommendation_specialexposures']);
            if (sizeof($recImmunParams['recommendation_immunisations']) == 0) {
                $preview .= '<h4>'.getContent('nohrec', 'content1', $language->id).'</h4>';
            } else {
                $preview .= '<h4>'.getContent('healthrec', 'content1', $language->id).'</h4>';
                $preview .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                foreach ($recImmunParams['recommendation_immunisations'] as $immun_id) {
                    $immunisation = Immunisation::find($immun_id);
                    $longtermstay = array_search($immunisation->id, $recImmunParams['recommendation_longtermstays']) !== false ? true : false;
                    $specialexposure = array_search($immunisation->id, $recImmunParams['recommendation_specialexposures']) !== false ? true : false;

                    if ($immunisation) {
                        $preview .= '<li>'.($immunisation->languages->find($language->id)->pivot->content ?? $immunisation->content);

                        if ($longtermstay && $specialexposure) {
                            $preview .= ', '.$trans_hr_ltsse;
                        } else if ($longtermstay) {
                            $preview .= ', '.$trans_hr_lts;
                        } else if ($specialexposure) {
                            $preview .= ', '.$trans_hr_se;
                        }

                        $preview .= '</li>';
                    }
                }
                $preview .= '</ul>';
            }

            $preview .= '<br>';

            $specParams = $request->getParams(['inoculationspecifics']);
            foreach ($specParams['inoculationspecifics'] as $spec_id) {
                $specific = Inoculationspecific::find($spec_id);
                if ($specific) {
                    $preview .= '<h4>'.getContent($specific->contentcode, 'text1', $language->id).'</h4>';
                    $preview .= '<p>'.getContent($specific->contentcode, 'content1', $language->id).'</p>';
                }
            }
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'sp') &&
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
                                $headline = $contentgroup->getContent($lang);
                            }
                        }
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                    }
                }
            }
            $preview .= '<br>';

            if ($request_data['pregnant']) {
                $preview .= '<h4>'.getContent('headpreg', 'text1', $language->id).'</h4>';
                $preview .= '<p>'.getContent('headpreg', 'content1', $language->id).'</p>';

                $preview .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                $optpregParams = $request->getParams(['optionpregnants']);
                foreach ($optpregParams['optionpregnants'] as $preg_id) {
                    $pregnant = Inooptionpregnant::find($preg_id);
                    if ($pregnant) {
                        $preview .= '<li>'.($pregnant->languages->find($language->id)->pivot->content ?? $pregnant->content).'</li>';
                    }
                }
                $preview .= '</ul>';
            }
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'op') &&
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
                                $headline = $contentgroup->getContent($lang);
                            }
                        }
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                    }
                }
            }
            $preview .= '<br>';

            if ($request_data['child']) {
                $preview .= '<h4>'.getContent('headchild', 'text1', $language->id).'</h4>';
                $preview .= '<p>'.getContent('headchild', 'content1', $language->id).'</p>';

                $preview .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                $optchildParams = $request->getParams(['optionchildren']);
                foreach ($optchildParams['optionchildren'] as $child_id) {
                    $child = Inooptionchild::find($child_id);
                    if ($child) {
                        $preview .= '<li>'.($child->languages->find($language->id)->pivot->content ?? $child->content).'</li>';
                    }
                }
                $preview .= '</ul>';
            }
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'oc') &&
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
                                $headline = $contentgroup->getContent($lang);
                            }
                        }
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                    }
                }
            }
            $preview .= '<br>';

            if ($request_data['yf'] && isset($request_data['yellowfever_id'])) {
                $yellowfever_id = $request_data['yellowfever_id'];
                $yellowfever = Yellowfever::find($yellowfever_id);
                if ($yellowfever->id == 1) {    // risk countries
                    $preview .= '<h4>'.getContent('yfinfection', 'text1', $language->id).'</h4>';
                    $preview .= '<p>'.getContent('yfinfection', 'content1', $language->id).'</p>';

                    if($request_data['ggmonth']) {
                        $preview .= str_replace("%%Age%%", $request_data['ggmonth'],
                            getContent('yfage', 'content1', $language->id));
                    }
                    if($request_data['transitingeneral']) {
                        $preview .= getContent('yftransit', 'content1', $language->id);
                    }
                    if($request_data['transittime12hours']) {
                        $preview .= getContent('yftransittwelve', 'content1', $language->id);
                    }

                    $preview .= '<h4>'.getContent('yfcountries', 'text1', $language->id).'</h4>';
                    $preview .= '<p>'.getContent('yfcountries', 'content1', $language->id).'</p>';
                } else if ($yellowfever->id == 2) {    // all countries
                    $preview .= '<h4>'.getContent('yfall', 'text1', $language->id).'</h4>';
                    $preview .= '<p>'.getContent('yfall', 'content1', $language->id).'</p>';

                    if ($request_data['ggmonth']) {
                        $preview .= str_replace("%%Age%%", $request_data['ggmonth'],
                            getContent('yfage', 'content1', $language->id));
                    }

                    if ($request_data['transitingeneral']) {
                        $preview .= getContent('yftransit', 'content1', $language->id);
                    }
                    if ($request_data['transittime12hours']) {
                        $preview .= getContent('yftransittwelve', 'content1', $language->id);
                    }
                }
            }

            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'yf') &&
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
                                $headline = $contentgroup->getContent($lang);
                            }
                        }
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                    }
                }
            }
            $preview .= '<br>';

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
                                $headline = $contentgroup->getContent($lang);
                            }
                        }
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                    }
                }
            }
            $preview .= '<br>';

        }

        return [
            'title' => $title,
            'content' => $preview
        ];
    }

}
