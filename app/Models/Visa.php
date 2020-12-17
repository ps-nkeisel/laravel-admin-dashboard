<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Language;
use App\Http\Requests\VisaFormRequest;

class Visa extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visas';

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

                'linkresource',
                'textresource',

                'free',
                'freedays',

                'online',
                'onarrival',
                'foreignrepresentation',
                'noorderinformation',

                'evisalink',

                'online_handlingtime_from',
                'online_handlingtime_to',
                'online_weeks',

                'foreign_handlingtime_from',
                'foreign_handlingtime_to',
                'foreign_weeks',

                'schengen',
                'require1',
                'require2',
                'require3',
                'supply1',
                'supply2',
                'supply3',
                'supply4',
                'resourcechanged',
                'status',

                'controlled_at',
                'controlled_ip',
                'controlled_user',
                'created_ip',
                'created_user',
                'updated_ip',
                'updated_user',
                'uuid',

                'active',
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

    public function visadocuments() {
        return $this->belongsToMany(Visadocument::class, 'visadocassigns', 'visa_id', 'visadocument_id')->orderBy('position')->withTimestamps()
            ->withPivot('created_user', 'created_ip', 'active', 'archive');
    }


    public function contentadditionals() {
        return $this->morphMany(Contentadditional::class, 'contentadditionalable')->orderBy('position');
    }

    public function required_contentadditionals() {
        return $this->contentadditionals()->where('section', 'req');
    }

    public function orderonline_contentadditionals() {
        return $this->contentadditionals()->where('section', 'orderon');
    }

    public function orderforeign_contentadditionals() {
        return $this->contentadditionals()->where('section', 'orderrep');
    }

    public function orderonarrival_contentadditionals() {
        return $this->contentadditionals()->where('section', 'orderarr');
    }

    public function beforedocument_contentadditionals() {
        return $this->contentadditionals()->where('section', 'bd');
    }

    public function afterdocument_contentadditionals() {
        return $this->contentadditionals()->where('section', 'ad');
    }

    public function entrybyland_contentadditionals() {
        return $this->contentadditionals()->where('section', 'ebl');
    }

    public function entrybysea_contentadditionals() {
        return $this->contentadditionals()->where('section', 'ebs');
    }

    public function afterentrybysea_contentadditionals() {
        return $this->contentadditionals()->where('section', 'aebs');
    }

    public function footer_contentadditionals() {
        return $this->contentadditionals()->where('section', 'fo');
    }


    public static function contentgroups() {
        return Contentgroup::where('contentadditionalable_type', 'LIKE', '%Visa%');
    }

    public static function required_contentgroups() {
        return Visa::contentgroups()->where('section', 'req');
    }

    public static function orderonline_contentgroups() {
        return Visa::contentgroups()->where('section', 'orderon');
    }

    public static function orderforeign_contentgroups() {
        return Visa::contentgroups()->where('section', 'orderrep');
    }

    public static function orderonarrival_contentgroups() {
        return Visa::contentgroups()->where('section', 'orderarr');
    }

    public static function beforedocument_contentgroups() {
        return Visa::contentgroups()->where('section', 'bd');
    }

    public static function afterdocument_contentgroups() {
        return Visa::contentgroups()->where('section', 'ad');
    }

    public static function entrybyland_contentgroups() {
        return Visa::contentgroups()->where('section', 'ebl');
    }

    public static function entrybysea_contentgroups() {
        return Visa::contentgroups()->where('section', 'ebs');
    }

    public static function afterentrybysea_contentgroups() {
        return Visa::contentgroups()->where('section', 'aebs');
    }

    public static function footer_contentgroups() {
        return Visa::contentgroups()->where('section', 'fo');
    }


    public function getReport($language) {
        $title = getContent('headvisa', 'content1', $language->id).' version '.$this->version;

        $report = '<h4>'.getTranslation('vs.h', $language->code).'</h4>';

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('vsnia', 'content1', $language->id).'</p>';
        } else {
            if ($this->require1 == 1) {
                $report .= '<p>'.getContent('vr', 'content1', $language->id).'</p>';
            } else if ($this->require1 == 2) {
                $report .= '<p>'.str_replace('%%Period of travel%%', $this->freedays,
                    getContent('vfreedays', 'content1', $language->id)).'</p>';
            } else if ($this->require1 == 0) {
                $report .= '<p>'.getContent('vnr', 'content1', $language->id).'</p>';
            }

            if (count($this->required_contentadditionals)) {
                foreach ($this->required_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if ($this->require1 == 1) {
                $report .= '<table class="table table-bordered table-hover text-center">'.
                    '<thead>'.
                        '<tr>'.
                            '<th width="250px">'.getTranslation('vs.tab.1', $language->code).'</th>'.
                            '<th width="140px">'.getTranslation('vs.tab.2', $language->code).'</th>'.
                            '<th width="220px">'.getTranslation('vs.tab.3', $language->code).'<sup>1</sup></th>'.
                            '<th style="white-space:nowrap;">'.getTranslation('vs.tab.4', $language->code).'</th>'.
                        '</tr>'.
                    '</thead>'.
                    '<tbody>';

                $report_vpoint = '<p>'.getContent('vpoint', 'content1', $language->id).'</p>';

                $report_vpoint .= '<ol class="list-number-bracket">';
                $report_vpoint .= '<li>'.getContent('vtabproc', 'content1', $language->id).'</li>';

                $vindi = 0;
                if ($this->foreignrepresentation) {
                    if ($this->foreign_handlingtime_from == 0 && !$this->foreign_weeks) {
                        $vindi = 1;
                    }
                }
                if ($this->online) {
                    if ($this->online_handlingtime_from == 0 && !$this->online_weeks) {
                        $vindi = 1;
                    }
                }

                $report .= '<tr>';
                $report .= '<td>'.getTranslation('vs.tab.5', $language->code);
                $conadd_num = 2;
                if ($vindi == 1) {
                    $report_vpoint .= '<li>'.getContent('vindi', 'content1', $language->id).'</li>';
                    $conadd_num ++;
                }

                $conadd_num_next = $conadd_num;
                foreach ($this->orderforeign_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report_vpoint .= '<li>'.nl2br($languageContent->pivot->content).'</li>';
                        $conadd_num_next ++;
                    }
                }
                if ($conadd_num_next > $conadd_num) {
                    $report .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                }
                $conadd_num = $conadd_num_next;

                $report .= '</td>';

                if ($this->foreignrepresentation) {
                    $report .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';

                    $report .= '<td>';
                    if ($this->foreign_handlingtime_from > 0 && $this->foreign_handlingtime_to > 0) {
                        $report .= $this->foreign_handlingtime_from.'-'.$this->foreign_handlingtime_to.' '.getTranslation('vs.tab.day', $language->code);
                    } else if ($this->foreign_handlingtime_from > 0) {
                        $report .= $this->foreign_handlingtime_from.' '.getTranslation('vs.tab.day', $language->code);
                    } else if ($this->foreign_weeks) {
                        $report .= getTranslation('vs.tab.few', $language->code);
                    } else {
                        $report .= getTranslation('vs.tab.procin', $language->code);
                        $report .= '<sup>2</sup>';
                    }
                    $report .= '</td>';
                    $report .= '<td>'.getContent('vtabrep', 'content1', $language->id).'</td>';
                } else {
                    $report .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                    $report .= '<td></td>';
                    $report .= '<td>'.getContent('vtabrep0', 'content1', $language->id).'</td>';
                }
                $report .= '</tr>';

                $report .= '<tr>';
                $report .= '<td>'.getTranslation('vs.tab.6', $language->code);

                $conadd_num_next = $conadd_num;
                $evisalink = !empty($this->evisalink);
                foreach ($this->orderonline_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report_vpoint .= '<li>';
                        if ($evisalink) {
                            $report_vpoint .= getContent('evisalink', 'content1', $language->id).' : '.$this->evisalink;
                            $report_vpoint .= '<span class="d-block">'.nl2br($languageContent->pivot->content).'</span>';
                            $evisalink = false;
                        } else {
                            $report_vpoint .= nl2br($languageContent->pivot->content);
                        }
                        $report_vpoint .= '</li>';
                        $conadd_num_next ++;
                    }
                }
                if ($evisalink) {
                    $report_vpoint .= '<li>'.getContent('evisalink', 'content1', $language->id).' : '.$this->evisalink.'</li>';
                    $conadd_num_next ++;
                }
                if ($conadd_num_next > $conadd_num) {
                    $report .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                }
                $conadd_num = $conadd_num_next;

                $report .= '</td>';

                if ($this->online) {
                    $report .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';

                    $report .= '<td>';
                    if ($this->online_handlingtime_from > 0 && $this->online_handlingtime_to > 0) {
                        $report .= $this->online_handlingtime_from.'-'.$this->online_handlingtime_to.' '.getTranslation('vs.tab.day', $language->code);
                    } else if ($this->online_handlingtime_from > 0) {
                        $report .= $this->online_handlingtime_from.' '.getTranslation('vs.tab.day', $language->code);
                    } else if ($this->online_weeks) {
                        $report .= getTranslation('vs.tab.few', $language->code);
                    } else {
                        $report .= getTranslation('vs.tab.procin', $language->code);
                        $report .= '<sup>2</sup>';
                    }
                    $report .= '</td>';
                    $report .= '<td>'.getContent('vtabonl', 'content1', $language->id).'</td>';
                } else {
                    $report .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                    $report .= '<td></td>';
                    $report .= '<td>'.getContent('vtabonl0', 'content1', $language->id).'</td>';
                }
                $report .= '</tr>';

                $report .= '<tr>';
                $report .= '<td>'.getTranslation('vs.tab.7', $language->code);

                $conadd_num_next = $conadd_num;
                foreach ($this->orderonarrival_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report_vpoint .= '<li>'.nl2br($languageContent->pivot->content).'</li>';
                        $conadd_num_next ++;
                    }
                }
                if ($conadd_num_next > $conadd_num) {
                    $report .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                }
                $conadd_num = $conadd_num_next;

                $report .= '</td>';

                if ($this->onarrival) {
                    $report .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';
                    $report .= '<td></td>';
                    $report .= '<td>'.getContent('vtabarr', 'content1', $language->id).'</td>';
                } else {
                    $report .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                    $report .= '<td></td>';
                    $report .= '<td>'.getContent('vtabarr0', 'content1', $language->id).'</td>';
                }
                $report .= '</tr>';

                $report .= '</tbody>'.
                    '</table>';

                $report_vpoint .= '</ol>';

                $report .= $report_vpoint;
            }

            if (count($this->beforedocument_contentadditionals)) {
                foreach ($this->beforedocument_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            $visadocuments = $this->visadocuments()->wherePivot('active', 1)->get();
            if (sizeof($visadocuments)) {
                $report .= '<h4>'.getContent('dr', 'content1', $language->id).'</h4>';
                $report .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                foreach ($visadocuments as $visadocument) {
                    $languageContent = $visadocument->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<li>'.$languageContent->pivot->content.'</li>';
                    } else {
                        $report .= '<li>'.$visadocument->content.'</li>';
                    }
                }
                $report .= '</ul>';
            }

            if (count($this->afterdocument_contentadditionals)) {
                foreach ($this->afterdocument_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if ($this->require1 == 1) {
                $report .= '<p>'.getContent('validity', 'content1', $language->id).'</p>';
            }

            if (count($this->entrybyland_contentadditionals)) {
                $report .= '<h4>'.getTranslation('v.ebl', $language->code).'</h4>';
                foreach ($this->entrybyland_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if (count($this->entrybysea_contentadditionals)) {
                $report .= '<h4>'.getTranslation('v.ebs', $language->code).'</h4>';
                foreach ($this->entrybysea_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if (count($this->afterentrybysea_contentadditionals)) {
                $report .= '<h4>'.getTranslation('v.aebs', $language->code).'</h4>';
                foreach ($this->afterentrybysea_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if ($this->footer_contentadditionals->count()) {
                //$report .= '<h4>'.getTranslation('hr.ac', $language->code).'</h4>';
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
        $title = getContent('headvisa', 'content1', $language->id);

        $report = "";

        if ($this->no_info_available) {
            $report .= getContent('vsnia', 'content1', $language->id);
        } else {
            if ($this->require1 == 1) {
                $report .= getContent('vr', 'content1', $language->id);
            } else if ($this->require1 == 2) {
                $report .= str_replace('%%Period of travel%%', $this->freedays,
                    getContent('vfreedays', 'content1', $language->id));
            } else if ($this->require1 == 0) {
                $report .= getContent('vnr', 'content1', $language->id);
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'req')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 1, "");

            if ($this->require1 == 1) {
                // Headline
                $report .= '<br><br><b>'.getTranslation('vs.tab.1', $language->code).'</b>';

                // foreign
                if ($this->foreignrepresentation) {
                    // Headline
                    $report .= '<br><br>'.getTranslation('vs.tab.5', $language->code);
                    // Erläuterung
                    $report .= '<br>' . getTranslation('vs.tab.4', $language->code).': ';
                    $report .= getContent('vtabrep', 'content1', $language->id);
                    // Additional Content
                    $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                        $que->where('language_id', $language->id);
                    }])->where('section', 'orderrep')->get();
                    $report .= formatAcToWeb($contentadditionals, $language, 0, "");

                    $report .= '<br>' . getTranslation('vs.tab.3', $language->code).': ';

                    if ($this->foreign_handlingtime_from > 0 && $this->foreign_handlingtime_to > 0) {
                        $report .= $this->foreign_handlingtime_from.'-'.$this->foreign_handlingtime_to.' '.getTranslation('vs.tab.day', $language->code);
                        // Bitte beachten Sie, dass die Bearbeitungszeit...
                        $report .= '<br>'. getContent('vtabproc', 'content1', $language->id);
                    } else if ($this->foreign_handlingtime_from > 0) {
                        $report .= '<br>'. $this->foreign_handlingtime_from.' '.getTranslation('vs.tab.day', $language->code);
                        // Bitte beachten Sie, dass die Bearbeitungszeit...
                        $report .= '<br>'. getContent('vtabproc', 'content1', $language->id);
                    } else if ($this->foreign_weeks) {
                        $report .= getTranslation('vs.tab.few', $language->code);
                        // Bitte beachten Sie, dass die Bearbeitungszeit...
                        $report .= '<br>'. getContent('vtabproc', 'content1', $language->id);
                    } else {
                        $report .= getTranslation('vs.tab.procin', $language->code);
                        // Die Visabeantragung wird individuell geprüft
                        $report .= "<br>".getContent('vindi', 'content1', $language->id);
                    }
                }

                // online
                if ($this->online) {
                    if ($this->foreignrepresentation) {
                        $report .= '<br>';
                    }
                    // Headline
                    $report .= '<br>'.getTranslation('vs.tab.6', $language->code);
                    // Erläuterung
                    $report .= '<br>' . getTranslation('vs.tab.4', $language->code).': ';
                    $report .= getContent('vtabonl', 'content1', $language->id);
                    // E-Visa Link
                    if (!empty($this->evisalink)) {
                        $report .= '<br>' . getContent('evisalink', 'content1', $language->id).' : '.$this->evisalink;
                    }
                    // Additional Content
                    $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                        $que->where('language_id', $language->id);
                    }])->where('section', 'orderon')->get();
                    $report .= formatAcToWeb($contentadditionals, $language, 0, "");
                    // durchschnittliche Bearbeitungszeit
                    $report .= '<br>'.getTranslation('vs.tab.3', $language->code).': ';

                    if ($this->online_handlingtime_from > 0 && $this->online_handlingtime_to > 0) {
                        $report .= $this->online_handlingtime_from.'-'.$this->online_handlingtime_to.' '.getTranslation('vs.tab.day', $language->code);
                        // Bitte beachten Sie, dass die Bearbeitungszeit...
                        $report .= '<br>'. getContent('vtabproc', 'content1', $language->id);
                    } else if ($this->online_handlingtime_from > 0) {
                        $report .= $this->online_handlingtime_from.' '.getTranslation('vs.tab.day', $language->code);
                        // Bitte beachten Sie, dass die Bearbeitungszeit...
                        $report .= '<br>'. getContent('vtabproc', 'content1', $language->id);
                    } else if ($this->online_weeks) {
                        $report .= getTranslation('vs.tab.few', $language->code);
                        // Bitte beachten Sie, dass die Bearbeitungszeit...
                        $report .= '<br>'. getContent('vtabproc', 'content1', $language->id);
                    } else {
                        // individuell
                        $report .= getTranslation('vs.tab.procin', $language->code);
                        // Die Visabeantragung wird individuell geprüft
                        $report .= "<br>".getContent('vindi', 'content1', $language->id);
                    }
                }

                // onarrival
                if ($this->onarrival) {
                    if ($this->foreignrepresentation && !$this->online) {
                        $report .= '<br>';
                    }

                    if ($this->online) {
                        $report .= '<br>';
                    }

                    // Headline
                    $report .= '<br>'.getTranslation('vs.tab.7', $language->code);
                    // Erläuterung
                    $report .= '<br>' . getTranslation('vs.tab.4', $language->code).': ';
                    $report .= getContent('vtabarr', 'content1', $language->id);
                    // Additional Content
                    $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                        $que->where('language_id', $language->id);
                    }])->where('section', 'orderarr')->get();
                    $report .= formatAcToWeb($contentadditionals, $language, 0, "");
                }
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'bd')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 1, "");

            //mitzuführende Dokumente
            $this->load('visadocuments.languages');
            $visadocuments = $this->visadocuments()->wherePivot('active', 1)->get();
            if (count($visadocuments)) {
                $report .= '<br><br><b>'.getContent('dr', 'content1', $language->id).'</b>';
                foreach ($visadocuments as $visadocument) {
                    $languageContent = $visadocument->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<br>- ' . $languageContent->pivot->content;
                    } else {
                        $report .= '<br>- ' . $visadocument->content;
                    }
                }
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'ad')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 1, "");

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'ebl')->get();
            $report .= '<br>' . formatAcToWeb($contentadditionals, $language, 1, "", false, "v.ebl");

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'ebs')->get();
            $report .= '<br>' . formatAcToWeb($contentadditionals, $language, 1, "", false, "v.ebs");

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'aebs')->get();
            $report .= '<br>' . formatAcToWeb($contentadditionals, $language, 1, "", false, "v.aebs");

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'fo')->get();
            $report .= '<br>' . formatAcToWeb($contentadditionals, $language, 0, "");

            // Text for recommendation for visumpoint
            if ($this->require1 == 1) {
                $report .= '<br><br><p>'.getContent('vpoint', 'content1', $language->id).'</p>';
            }

        }

        return [
            'title' => $title,
            'content' => $report
        ];
    }

    public static function getPreview(VisaFormRequest $request, $language) {
        $request_data = $request->getData();

        $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'contentgroups']);

        $title = getContent('headvisa', 'content1', $language->id);

        $preview = '<h4>'.getTranslation('vs.h', $language->code).'</h4>';

        if ($request_data['no_info_available']) {
            $preview .= '<p>'.getContent('vsnia', 'content1', $language->id).'</p>';
        } else {
            if ($request_data['require1'] == 1) {
                $preview .= '<p>'.getContent('vr', 'content1', $language->id).'</p>';
            } else if ($request_data['require1'] == 2) {
                $preview .= '<p>'.str_replace('%%Period of travel%%', $request_data['freedays'],
                    getContent('vfreedays', 'content1', $language->id)).'</p>';
            } else if ($request_data['require1'] == 0) {
                $preview .= '<p>'.getContent('vnr', 'content1', $language->id).'</p>';
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
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                        $preview .= '<br>';
                    }
                }
            }

            if ($request_data['require1'] == 1) {
                $preview .= '<table class="table table-bordered table-hover text-center">'.
                    '<thead>'.
                        '<tr>'.
                            '<th width="250px">'.getTranslation('vs.tab.1', $language->code).'</th>'.
                            '<th width="140px">'.getTranslation('vs.tab.2', $language->code).'</th>'.
                            '<th width="220px">'.getTranslation('vs.tab.3', $language->code).'<sup>1</sup></th>'.
                            '<th style="white-space:nowrap;">'.getTranslation('vs.tab.4', $language->code).'</th>'.
                        '</tr>'.
                    '</thead>'.
                    '<tbody>';

                $preview_vpoint = '<h5>'.getContent('vpoint', 'content1', $language->id).'</h5>';

                $preview_vpoint .= '<ol class="list-number-bracket">';
                $preview_vpoint .= '<li>'.getContent('vtabproc', 'content1', $language->id).'</li>';

                $vindi = 0;
                if ($request_data['foreignrepresentation']) {
                    if ($request_data['foreign_handlingtime_from'] == 0 && !$request_data['foreign_weeks']) {
                        $vindi = 1;
                    }
                }
                if ($request_data['online']) {
                    if ($request_data['online_handlingtime_from'] == 0 && !$request_data['online_weeks']) {
                        $vindi = 1;
                    }
                }

                $preview .= '<tr>';
                $preview .= '<td>'.getTranslation('vs.tab.5', $language->code);
                $conadd_num = 2;
                if ($vindi == 1) {
                    $preview_vpoint .= '<li>'.getContent('vindi', 'content1', $language->id).'</li>';
                    $conadd_num ++;
                }

                $conadd_num_next = $conadd_num;
                foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                    if (($contentadditionalsParam['languageSections'][$position] == 'orderrep') &&
                        (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                        array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                    {
                        $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                        $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                        if (!empty(trim($headline)) || !empty(trim($content))) {
                            $preview_vpoint .= '<li>'.nl2br($content).'</li>';
                            $conadd_num_next ++;
                        }
                    }
                }
                if ($conadd_num_next > $conadd_num) {
                    $preview .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                }
                $conadd_num = $conadd_num_next;

                $preview .= '</td>';

                if ($request_data['foreignrepresentation']) {
                    $preview .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';

                    $preview .= '<td>';
                    if ($request_data['foreign_handlingtime_from'] > 0 && $request_data['foreign_handlingtime_to'] > 0) {
                        $preview .= $request_data['foreign_handlingtime_from'].'-'.$request_data['foreign_handlingtime_to'].' days';
                    } else if ($request_data['foreign_handlingtime_from'] > 0) {
                        $preview .= $request_data['foreign_handlingtime_from'].' days';
                    } else if ($request_data['foreign_weeks']) {
                        $preview .= getTranslation('vs.tab.few', $language->code);
                    } else {
                        $preview .= getTranslation('vs.tab.procin', $language->code);
                        $preview .= '<sup>2</sup>';
                    }
                    $preview .= '</td>';
                    $preview .= '<td>'.getContent('vtabrep', 'content1', $language->id).'</td>';
                } else {
                    $preview .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                    $preview .= '<td></td>';
                    $preview .= '<td>'.getContent('vtabrep0', 'content1', $language->id).'</td>';
                }
                $preview .= '</tr>';

                $preview .= '<tr>';
                $preview .= '<td>'.getTranslation('vs.tab.6', $language->code);

                $conadd_num_next = $conadd_num;
                $evisalink = !empty($request_data['evisalink']);
                foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                    if (($contentadditionalsParam['languageSections'][$position] == 'orderon') &&
                        (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                        array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                    {
                        $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                        $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                        if (!empty(trim($headline)) || !empty(trim($content))) {
                            $preview_vpoint .= '<li>';
                            if ($evisalink) {
                                $preview_vpoint .= getContent('evisalink', 'content1', $language->id).' : '.$request_data['evisalink'];
                                $preview_vpoint .= '<span class="d-block">'.nl2br($content).'</span>';
                                $evisalink = false;
                            } else {
                                $preview_vpoint .= nl2br($content);
                            }
                            $preview_vpoint .= '</li>';
                            $conadd_num_next ++;
                        }
                    }
                }
                if ($evisalink) {
                    $preview_vpoint .= '<li>'.getContent('evisalink', 'content1', $language->id).' : '.$request_data['evisalink'].'</li>';
                    $conadd_num_next ++;
                }
                if ($conadd_num_next > $conadd_num) {
                    $preview .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                }
                $conadd_num = $conadd_num_next;

                $preview .= '</td>';

                if ($request_data['online']) {
                    $preview .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';

                    $preview .= '<td>';
                    if ($request_data['online_handlingtime_from'] > 0 && $request_data['online_handlingtime_to'] > 0) {
                        $preview .= $request_data['online_handlingtime_from'].'-'.$request_data['online_handlingtime_to'].' days';
                    } else if ($request_data['online_handlingtime_from'] > 0) {
                        $preview .= $request_data['online_handlingtime_from'].' days';
                    } else if ($request_data['online_weeks']) {
                        $preview .= getTranslation('vs.tab.few', $language->code);
                    } else {
                        $preview .= getTranslation('vs.tab.procin', $language->code);
                        $preview .= '<sup>2</sup>';
                    }
                    $preview .= '</td>';
                    $preview .= '<td>'.getContent('vtabonl', 'content1', $language->id).'</td>';
                } else {
                    $preview .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                    $preview .= '<td></td>';
                    $preview .= '<td>'.getContent('vtabonl0', 'content1', $language->id).'</td>';
                }
                $preview .= '</tr>';

                $preview .= '<tr>';
                $preview .= '<td>'.getTranslation('vs.tab.7', $language->code);

                $conadd_num_next = $conadd_num;
                foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                    if (($contentadditionalsParam['languageSections'][$position] == 'orderarr') &&
                        (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                        array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                    {
                        $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                        $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                        if (!empty(trim($headline)) || !empty(trim($content))) {
                            $preview_vpoint .= '<li>'.nl2br($content).'</li>';
                            $conadd_num_next ++;
                        }
                    }
                }
                if ($conadd_num_next > $conadd_num) {
                    $preview .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                }
                $conadd_num = $conadd_num_next;

                $preview .= '</td>';

                if ($request_data['onarrival']) {
                    $preview .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';
                    $preview .= '<td></td>';
                    $preview .= '<td>'.getContent('vtabarr', 'content1', $language->id).'</td>';
                } else {
                    $preview .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                    $preview .= '<td></td>';
                    $preview .= '<td>'.getContent('vtabarr0', 'content1', $language->id).'</td>';
                }
                $preview .= '</tr>';

                $preview .= '</tbody>'.
                    '</table>';

                $preview_vpoint .= '</ol>';

                $preview .= $preview_vpoint;
            }

            $preview .= Visa::formatPreviewAcToWeb($contentadditionalsParam, 'bd', $language);

            $visadocParams = $request->getParams(['visadocuments']);
            if (sizeof($visadocParams['visadocuments'])) {
                $preview .= '<h4>'.getContent('dr', 'content1', $language->id).'</h4>';
                $preview .= '<ul style="margin-top:-15px;margin-bottom:30px;">';
                $visadocuments = Visadocument::orderBy('position', 'asc')->get();
                foreach ($visadocParams['visadocuments'] as $visadoc_id) {
                    $visadocument = Visadocument::find($visadoc_id);
                    $languageContent = $visadocument->languages->find($language->id);
                    if ($languageContent) {
                        $preview .= '<li>'.$languageContent->pivot->content.'</li>';
                    } else {
                        $preview .= '<li>'.$visadocument->content.'</li>';
                    }
                }
                $preview .= '</ul>';
            }

            $preview .= Visa::formatPreviewAcToWeb($contentadditionalsParam, 'ad', $language);

            if ($request_data['require1'] == 1) {
                $preview .= '<p>'.getContent('validity', 'content1', $language->id).'</p>';
            }

            $preview .= '<h4>'.getTranslation('v.ebl', $language->code).'</h4>';
            $preview .= Visa::formatPreviewAcToWeb($contentadditionalsParam, 'ebl', $language);

            $preview .= '<h4>'.getTranslation('v.ebs', $language->code).'</h4>';
            $preview .= Visa::formatPreviewAcToWeb($contentadditionalsParam, 'ebs', $language);

            $preview .= '<h4>'.getTranslation('v.aebs', $language->code).'</h4>';
            $preview .= Visa::formatPreviewAcToWeb($contentadditionalsParam, 'aebs', $language);

            $preview .= '<h4>'.getTranslation('hr.ac', $language->code).'</h4>';
            $preview .= Visa::formatPreviewAcToWeb($contentadditionalsParam, 'fo', $language);
        }

        return [
            'title' => $title,
            'content' => $preview
        ];
    }

    public static function formatPreviewAcToWeb($contentadditionalsParam, $section, $language)
    {
        $returnData = "";
        foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
            if (($contentadditionalsParam['languageSections'][$position] == $section) &&
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
                    $returnData .= '<h5>'.$headline.'</h5>';
                    $returnData .= '<p>'.nl2br($content).'</p>';
                }
            }
        }
        return $returnData;
    }

}
