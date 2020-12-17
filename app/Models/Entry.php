<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Language;
use App\Http\Requests\EntryFormRequest;

class Entry extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entries';

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

                'temp_entry_stop',
                'no_info_available',

                'linkresource',
                'textresource',
                'handlingtime',

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

                'minor',

                'controlled_at',
                'controlled_ip',
                'controlled_user',
                'created_ip',
                'created_user',
                'updated_ip',
                'updated_user',
                'uuid',
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

    public function entryidentitydocuments() {
        return $this->belongsToMany(Entryidentitydocument::class, 'entrydocassigns', 'entry_id', 'entryidentitydocument_id')->withTimestamps()
            ->withPivot('created_user', 'created_ip', 'active', 'archive');
    }

    public function entrypassports() {
        return $this->belongsToMany(Entrypassport::class, 'entrypassassigns', 'entry_id', 'entrypassport_id')->orderBy('position')->withTimestamps()
            ->withPivot('active', 'months_validity', 'period', 'created_user', 'created_ip', 'archive');
    }

    public function entryaddinfos() {
        return $this->belongsToMany(Entryaddinfo::class, 'entryaddinfoassigns', 'entry_id', 'entryaddinfo_id')->orderBy('position')->withTimestamps()
            ->withPivot('active', 'created_user', 'created_ip', 'archive');
    }

    public function entryminors() {
        return $this->belongsToMany(Entryminor::class, 'entryminorassigns', 'entry_id', 'entryminor_id')->orderBy('position')->withTimestamps()
            ->withPivot('active', 'created_user', 'created_ip', 'archive');
    }


    public function contentadditionals() {
        return $this->morphMany(Contentadditional::class, 'contentadditionalable')->orderBy('position');
    }

    public function passport_contentadditionals() {
        return $this->contentadditionals()->where('section', 'pp');
    }

    public function afterpassport_contentadditionals() {
        return $this->contentadditionals()->where('section', 'ap');
    }

    public function addinfo_contentadditionals() {
        return $this->contentadditionals()->where('section', 'addin');
    }

    public function afteraddinfo_contentadditionals() {
        return $this->contentadditionals()->where('section', 'aa');
    }

    public function minor_contentadditionals() {
        return $this->contentadditionals()->where('section', 'minor');
    }

    public function footer_contentadditionals() {
        return $this->contentadditionals()->where('section', 'fo');
    }


    public static function contentgroups() {
        return Contentgroup::where('contentadditionalable_type', 'LIKE', '%Entry%');
    }

    public static function passport_contentgroups() {
        return Entry::contentgroups()->where('section', 'pp');
    }

    public static function afterpassport_contentgroups() {
        return Entry::contentgroups()->where('section', 'ap');
    }

    public static function addinfo_contentgroups() {
        return Entry::contentgroups()->where('section', 'addin');
    }

    public static function afteraddinfo_contentgroups() {
        return Entry::contentgroups()->where('section', 'aa');
    }

    public static function minor_contentgroups() {
        return Entry::contentgroups()->where('section', 'minor');
    }

    public static function footer_contentgroups() {
        return Entry::contentgroups()->where('section', 'fo');
    }


    public function getReport($language) {
        $title = getContent('headentry', 'content1', $language->id).' version '.$this->version;

        $report = '<h4>'.getTranslation('entry.h', $language->code).'</h4>';

        if ($this->temp_entry_stop) {
            $report .= '<p>'.getContent('entrytmps', 'content1', $language->id).'</p>';
        }

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('entrynia', 'content1', $language->id).'</p>';
        }

        if (!$this->temp_entry_stop && !$this->no_info_available) {
            if ($this->countrytocode != 'AQ') {
                $entrypassports = Entrypassport::orderBy('position', 'asc')->get();

                $report .= '<h4>'.getTranslation('en.pass.h1', $language->code).'</h4>';

                $report .= '<table class="table table-bordered table-hover text-center">'.
                    '<thead>'.
                        '<tr>'.
                            '<th width="250px">'.getTranslation('en.pass.col.d', $language->code).'<sup>1</sup></th>'.
                            '<th width="150px">'.getTranslation('en.pass.col.p', $language->code).'</th>'.
                            '<th style="white-space:nowrap;">'.getTranslation('en.pass.col.v', $language->code).'</th>'.
                        '</tr>'.
                    '</thead>'.
                    '<tbody>';

                $report_passportconadds = '<ol class="list-number-bracket mb-3">';

                $report_passportconadds .= '<li>'.getContent('en.table.td', 'content1', $language->id).'</li>';

                $conadd_num = 2;

                foreach ($entrypassports as $entrypassport) {
                    $entrypas = $this->entrypassports->find($entrypassport->id);

                    $report .= '<tr>';

                    if ($entrypas) {
                        $report .= '<td>'.$entrypas->getTranslation($language);

                        $conadd_num_next = $conadd_num;
                        $entrypas->contentadditionals = $this->passport_contentadditionals()->where('section_id', $entrypas->id)->get();
                        if(count($entrypas->contentadditionals)) {
                            foreach ($entrypas->contentadditionals as $contentadditional) {
                                $languageContent = $contentadditional->languages->find($language->id);
                                if ($languageContent) {
                                    $headline = $contentadditional->getHeadline($language);
                                    $content = $languageContent->pivot->content;
                                    $report_passportconadds .= '<li>';
                                    if (isset($headline) && $headline != "") {
                                        $report_passportconadds .= '<b>'.$headline.'</b><br>';
                                    }
                                    if (isset($content) && $content != "") {
                                        $report_passportconadds .= nl2br($content).'<br>';
                                    }
                                    $report_passportconadds .= '</li>';

                                    $conadd_num_next ++;
                                }
                            }
                            if ($conadd_num_next > $conadd_num) {
                                $report .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                                $conadd_num = $conadd_num_next;
                            }
                        }
                        $report .= '</td>';

                        $report .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';

                        $report .= '<td>';

                        if ($entrypas->pivot->period > 0) {
                            $months_validity_code = '';
                            if($entrypas->pivot->period == 1) {
                                $months_validity_code = 'en.pass.byond';
                            } else if($entrypas->pivot->period == 2) {
                                $months_validity_code = 'en.pass.arrival';
                            } else if($entrypas->pivot->period == 3) {
                                $months_validity_code = 'en.pass.during';
                            } else if($entrypas->pivot->period == 4) {
                                $months_validity_code = 'en.pass.elapsed';
                            }

                            if ($entrypas->pivot->months_validity > 0) {
                                $months_validity_str = getContent($months_validity_code, 'content1', $language->id);
                                $report .= str_replace('%%month_validity%%', $entrypas->pivot->months_validity, $months_validity_str);
                            } else {
                                $months_validity_code .= '0';
                                $report .= getContent($months_validity_code, 'content1', $language->id);
                            }
                        }
                        $report .= '</td>';
                    } else {
                        $report .= '<td>'.$entrypassport->getTranslation($language).'</td>';
                        $report .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                        $report .= '<td>'.getContent('en.pass.notallowed', 'content1', $language->id).'</td>';
                    }

                    $report .= '</tr>';
                }

                $report .= '</tbody>'.
                '</table>';

                $report_passportconadds .= '</ol>';

                $report .= $report_passportconadds;
            }

            if (count($this->afterpassport_contentadditionals)) {
                foreach ($this->afterpassport_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if (count($this->entryaddinfos)) {
                foreach ($this->entryaddinfos as $entryaddinfo) {
                    $report .= '<b>'.$entryaddinfo->getTranslation($language).'</b><br>';
                    $content = $entryaddinfo->getContent($language);
                    if (!empty($content)) {
                        $report .= $content.'<br>';
                    }

                    $entryaddinfo->contentadditionals = $this->addinfo_contentadditionals()->where('section_id', $entryaddinfo->id)->get();
                    if(count($entryaddinfo->contentadditionals)) {
                        foreach ($entryaddinfo->contentadditionals as $contentadditional) {
                            $languageContent = $contentadditional->languages->find($language->id);
                            if ($languageContent) {
                                $headline = $contentadditional->getHeadline($language);
                                $content = $languageContent->pivot->content;
                                if (!empty($headline)) {
                                    $report .= '<b>'.$headline.'</b><br>';
                                }
                                if (!empty($content)) {
                                    $report .= nl2br($content).'<br>';
                                }
                            }
                        }
                    }
                }
                $report .= '<br>';
            }

            if (count($this->afteraddinfo_contentadditionals)) {
                foreach ($this->afteraddinfo_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
                    }
                }
                $report .= '<br>';
            }

            if ($this->minor) {
                $report .= '<b>'.getContent('min1', 'text1', $language->id).'</b><br>';
                $report .= getContent('min1', 'content1', $language->id).'<br><br>';

                if (count($this->entryminors)) {
                    $report .= getContent('min2', 'content1', $language->id).'<br>';

                    $report .= '<ul>';
                    foreach ($this->entryminors as $entryminor) {
                        $report .= '<li>'.$entryminor->getTranslation($language).'</li>';
                    }
                    $report .= '</ul>';
                }

                if(count($this->minor_contentadditionals)) {
                    foreach ($this->minor_contentadditionals as $contentadditional) {
                        $languageContent = $contentadditional->languages->find($language->id);
                        if ($languageContent) {
                            $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                            $report .= nl2br($languageContent->pivot->content).'<br>';
                        }
                    }
                }
            }

            if (count($this->footer_contentadditionals)) {
                //$report .= '<br><b>'.getContent('entry.add', 'content1', $language->id).'</b></br>';

                foreach ($this->footer_contentadditionals as $contentadditional) {
                    $languageContent = $contentadditional->languages->find($language->id);
                    if ($languageContent) {
                        $report .= '<b>'.$contentadditional->getHeadline($language).'</b><br>';
                        $report .= nl2br($languageContent->pivot->content).'<br>';
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
        if ($this->temp_entry_stop) {
            return [
                'temp_entry_stop' => 1
            ];
        }

        $title = getContent('headentry', 'content1', $language->id);

        $report = "";

        if ($this->temp_entry_stop) {
            $report .= '<p>'.getContent('entrytmps', 'content1', $language->id).'</p>';
        }

        if ($this->no_info_available) {
            $report .= '<p>'.getContent('entrynia', 'content1', $language->id).'</p>';
        }

        if (!$this->temp_entry_stop && !$this->no_info_available) {
            $this->load('contentadditionals.languages');

            if ($this->countrytocode != 'AQ') {
                // Load passports
                $this->load('entrypassports', 'entrypassports.languages');
                $report .= '<b>'.getTranslation('en.pass.h1', $language->code).'</b><br>';

                $validity_headline = '<b>'.getTranslation('en.pass.col.v', $language->code).'</b><br>';

                $report_passportconadds = getTranslation('en.table.td', $language->code).'<br>';

                // Prepare array for possible travel documents
                $count = 0;
                $entryPasArr = array();
                foreach ($this->entrypassports as $entrypas) {
                    $entryPasName = $entrypas->getTranslation($language);
                    $entryPasArr[$count]['id'] = $entrypas->id;
                    $entryPasArr[$count]['content'] = $entrypas->content;
                    $entryPasArr[$count]['name'] = $entryPasName;
                    $entryPasArr[$count]['period'] = $entrypas->pivot->period;
                    $entryPasArr[$count]['monthValidity'] = $entrypas->pivot->months_validity;
                    $count++;
                }

                // BEGIN - Add text for possible travel documents
                if (isset($entryPasArr[0])) {
                    // Add List of possible travel documents
                    /*
                    foreach ($entryPasArr as $key => $value) {
                        $report .= '<br>- ' . $value['name'];
                    }
                    */
                    // Add validity of travel documents
                    $countPass = 0;
                    foreach ($entryPasArr as $key => $value) {
                        // Name of document
                        if ($countPass == 0) {
                            $report .= '<br>'.$value['name'];
                        } else {
                            $report .= '<br><br>'.$value['name'];
                        }

                        // Content for period
                        if ($value['period'] > 0) {
                            $months_validity_code = '';
                            if ($value['period'] == 1) {
                                $months_validity_code = 'en.pass.byond';
                            } else if ($value['period'] == 2) {
                                $months_validity_code = 'en.pass.arrival';
                            } else if ($value['period'] == 3) {
                                $months_validity_code = 'en.pass.during';
                            } else if ($value['period'] == 4) {
                                $months_validity_code = 'en.pass.elapsed';
                            } else if ($value['period'] == 5) {
                                $months_validity_code = 'en.pass.application';
                            } else if ($value['period'] == 6) {
                                $months_validity_code = 'en.pass.expiry';
                            }

                            if ($value['monthValidity'] > 0) {
                                $months_validity_str = getContent($months_validity_code, 'content1', $language->id);
                                $validity_contents = str_replace('%%month_validity%%', $value['monthValidity'], $months_validity_str);
                            } else {
                                $months_validity_code .= '0';
                                $validity_contents = getContent($months_validity_code, 'content1', $language->id);
                            }

                            $report .= "<br>" . $validity_contents;
                        }

                        // add additional content
                        $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                            $que->where('language_id', $language->id);
                        }])->where('section', 'pp')->where('section_id', $value['id'])->get();
                        $report .= formatAcToWeb($contentadditionals, $language, 0, "");

                        $countPass++;
                    }
                }
                // END - Add text for possible travel documents
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'ap')->get();
            $report .= "<br>" . formatAcToWeb($contentadditionals, $language, 1, "");

            $this->load('entryaddinfos', 'entryaddinfos.languages');
            if (count($this->entryaddinfos)) {
                $countEntryaddinfo = 0;
                $countEntryaddinfos = count($this->entryaddinfos);
                foreach ($this->entryaddinfos as $entryaddinfo) {
                    $entryaddinfoHeadline = $entryaddinfo->getTranslation($language);
                    $entryaddinfoContent = $entryaddinfo->getContent($language);

                    if ($countEntryaddinfo == 0) {
                        $report .= '<br>';
                    }

                    if (isset($entryaddinfoHeadline) && $entryaddinfoHeadline != "") {
                        $report .= '<br><b>'.$entryaddinfoHeadline.'</b>';
                        $report .= '<br>' . $entryaddinfoContent;
                    } else {
                        $report .= '<br>' . $entryaddinfoContent;
                    }

                    $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                        $que->where('language_id', $language->id);
                    }])->where('section', 'addin')->where('section_id', $entryaddinfo->id)->get();
                    $report .= formatAcToWeb($contentadditionals, $language, 0, "");

                    $countEntryaddinfo++;
                    if ($countEntryaddinfos != $countEntryaddinfo) {
                        $report .= '<br>';
                    }
                }
            }

            $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                $que->where('language_id', $language->id);
            }])->where('section', 'aa')->get();
            $report .= formatAcToWeb($contentadditionals, $language, 1, "");

            if ($this->minor) {
                $report .= '<br><br><b>'.getContent('min1', 'text1', $language->id).'</b><br>';
                $report .= getContent('min1', 'content1', $language->id);

                $this->load('entryminors', 'entryminors.languages');
                if (count($this->entryminors)) {
                    $report .= '<br><br>'.getContent('min2', 'content1', $language->id);

                    foreach ($this->entryminors as $entryminor) {
                        $report .= '<br>- '.$entryminor->getTranslation($language);
                    }
                }

                $contentadditionals = $this->contentadditionals()->with(['languages' => function ($que) use ($language) {
                    $que->where('language_id', $language->id);
                }])->where('section', 'minor')->get();
                $report .= formatAcToWeb($contentadditionals, $language, 1, "");

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

    public static function getPreview(EntryFormRequest $request, $language) {
        $request_data = $request->getData();

        $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'contentgroups']);

        $title = getContent('headentry', 'content1', $language->id);

        $preview = '<h4>'.getTranslation('entry.h', $language->code).'</h4>';

        if ($request_data['temp_entry_stop']) {
            $preview .= '<p>'.getContent('vstmps', 'content1', $language->id).'</p>';
        }

        if ($request_data['no_info_available']) {
            $preview .= '<p>'.getContent('entrynia', 'content1', $language->id).'</p>';
        }

        if (!$request_data['temp_entry_stop'] && !$request_data['no_info_available']) {
            if ($request_data['countrytocode'] != 'AQ') {
                $entrypassportParams = $request->getParams(['entrypassports', 'entrypassport_monthsvaliditys', 'passport_periods']);
                $entrypassports = Entrypassport::orderBy('position', 'asc')->get();

                $preview .= '<h4>'.getTranslation('en.pass.h1', $language->code).'</h4>';

                $preview .= '<table class="table table-bordered table-hover text-center">'.
                    '<thead>'.
                        '<tr>'.
                            '<th width="250px">'.getTranslation('en.pass.col.d', $language->code).'<sup>1</sup></th>'.
                            '<th width="100px">'.getTranslation('en.pass.col.p', $language->code).'</th>'.
                            '<th style="white-space:nowrap;">'.getTranslation('en.pass.col.v', $language->code).'</th>'.
                        '</tr>'.
                    '</thead>'.
                    '<tbody>';

                $preview_passportconadds = '<ol class="list-number-bracket mb-3">';

                $preview_passportconadds .= '<li>'.getContent('en.table.td', 'content1', $language->id).'</li>';

                $conadd_num = 2;

                foreach ($entrypassports as $entrypassport) {
                    $preview .= '<tr>';

                    if (in_array($entrypassport->id, $entrypassportParams['entrypassports'])) {
                        $preview .= '<td>'.$entrypassport->getTranslation($language);

                        $conadd_num_next = $conadd_num;
                        foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                            if (($contentadditionalsParam['languageSections'][$position] == 'pp') &&
                                ($contentadditionalsParam['languageSectionIds'][$position] == $entrypassport->id) &&
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
                                    $preview_passportconadds .= '<li>';
                                    if (isset($headline) && $headline != "") {
                                        $preview_passportconadds .= '<b>'.$headline.'</b><br>';
                                    }
                                    if (isset($content) && $content != "") {
                                        $preview_passportconadds .= nl2br($content).'<br>';
                                    }
                                    $preview_passportconadds .= '</li>';

                                    $conadd_num_next ++;
                                }
                            }
                        }
                        if ($conadd_num_next > $conadd_num) {
                            $preview .= '<sup>'.implode(',', range($conadd_num, $conadd_num_next-1)).'</sup>';
                            $conadd_num = $conadd_num_next;
                        }

                        $preview .= '</td>';

                        $preview .= '<td><i class="fas fa-2x fa-check text-success"></i></td>';

                        $preview .= '<td>';
                        $period = $entrypassportParams['passport_periods'][$entrypassport->id] ?? 0;

                        if($period > 0) {
                            $months_validity_code = '';
                            if($period == 1) {
                                $months_validity_code = 'en.pass.byond';
                            } else if($period == 2) {
                                $months_validity_code = 'en.pass.arrival';
                            } else if($period == 3) {
                                $months_validity_code = 'en.pass.during';
                            } else if($period == 4) {
                                $months_validity_code = 'en.pass.elapsed';
                            } else if($period == 5) {
                                $months_validity_code = 'en.pass.application';
                            } else if($period == 6) {
                                $months_validity_code = 'en.pass.expiry';
                            }

                            $months_validity = $entrypassportParams['entrypassport_monthsvaliditys'][$entrypassport->id];
                            if ($months_validity > 0) {
                                $months_validity_str = getContent($months_validity_code, 'content1', $language->id);
                                $preview .= str_replace('%%month_validity%%', $months_validity, $months_validity_str);
                            } else {
                                $months_validity_code .= '0';
                                $preview .= getContent($months_validity_code, 'content1', $language->id);
                            }
                        }

                        $preview .= '</td>';
                    } else {
                        $preview .= '<td>'.$entrypassport->getTranslation($language).'</td>';
                        $preview .= '<td><i class="fas fa-2x fa-times text-danger"></i></td>';
                        $preview .= '<td>'.getContent('en.pass.notallowed', 'content1', $language->id).'</td>';
                    }

                    $preview .= '</tr>';
                }
                $preview .= '</tbody>'.
                '</table>';

                $preview_passportconadds .= '</ol>';

                $preview .= $preview_passportconadds;
            }

            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'ap') &&
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
                    }
                }
            }
            $preview .= '<br>';

            $entryaddinfoParams = $request->getParams(['entryaddinfos']);
            if (sizeof($entryaddinfoParams['entryaddinfos']) > 0) {
                foreach ($entryaddinfoParams['entryaddinfos'] as $addinfo_id) {
                    $entryaddinfo = Entryaddinfo::find($addinfo_id);

                    $preview .= '<b>'.$entryaddinfo->getTranslation($language).'</b><br>';
                    $content = $entryaddinfo->getContent($language);
                    if (!empty($content)) {
                        $preview .= $content.'<br>';
                    }

                    foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                        if (($contentadditionalsParam['languageSections'][$position] == 'addin') &&
                            ($contentadditionalsParam['languageSectionIds'][$position] == $entryaddinfo->id) &&
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
                                if (!empty($headline)) {
                                    $preview .= '<b>'.$headline.'</b><br>';
                                }
                                if (!empty($content)) {
                                    $preview .= nl2br($content).'<br>';
                                }
                            }
                        }
                    }
                }
                $preview .= '<br>';
            }

            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'aa') &&
                    (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                    array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                {
                    $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                    $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                    if (!empty(trim($headline)) || !empty(trim($content))) {
                        if (empty($headline)) {
                            $contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? '';
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
                    }
                }
            }

            // Datensatz bearbeiten - Liste mit Dokumenten für Minderjährige (Vorschau)
            if ($request_data['minor']) {
                $preview .= '<b>'.getContent('min1', 'text1', $language->id).'</b></br>';
                $preview .= getContent('min1', 'content1', $language->id).'<br><br>';

                $entryminorParams = $request->getParams(['entryminors']);
                if (sizeof($entryminorParams['entryminors']) > 0) {
                    $preview .= getContent('min2', 'content1', $language->id).'<br>';

                    $preview .= '<ul>';
                    foreach ($entryminorParams['entryminors'] as $minor_id) {
                        $entryminor = Entryminor::find($minor_id);

                        $preview .= '<li>'.$entryminor->getTranslation($language).'</li>';
                    }
                    $preview .= '</ul>';
                }

                foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                    if (($contentadditionalsParam['languageSections'][$position] == 'minor') &&
                        (array_key_exists($language->id, $contentadditionalsParam['languageHeadlines'][$position]) ||
                        array_key_exists($language->id, $contentadditionalsParam['languageContents'][$position])))
                    {
                        $headline = $contentadditionalsParam['languageHeadlines'][$position][$language->id];
                        $content = $contentadditionalsParam['languageContents'][$position][$language->id];
                        if (!empty(trim($headline))) {
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
                        }
                    }
                }
            }

            //$preview .= '<br><b>'.getContent('entry.add', 'content1', $language->id).'</b></br>';

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
                            $preview .= '<b>'.$headline.'</b><br>';
                        }
                        if (!empty(trim($content))) {
                            $preview .= nl2br($content).'<br>';
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

}
