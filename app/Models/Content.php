<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents';

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
        'active',
        'archive',
        'assignto',
        'category',
        'client',
        'cluster',
        'code1',
        'code2',
        'code3',
        'content1',
        'content2',
        'controlled_at',
        'controlled_ip',
        'controlled_user',
        'created_ip',
        'created_user',
        'destco',
        'idversionbefore',
        'idversionnext',
        'lang',
        'nat',
        'position',
        'tech',
        'text1',
        'text2',
        'type',
        'updated_ip',
        'updated_user',
        'uuid',
        'validityfrom',
        'validityto',
        'version'
    ];

    protected $appends = [
        'language_content',
        'category_content',
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

    public function contentcategory() {
        return $this->belongsTo(Contentcategory::class, 'category');
    }

    public function getCategoryContentAttribute() {
        return $this->contentcategory ? $this->contentcategory->content : '';
    }

    public function createdUser() {
        return $this->belongsTo(User::class, 'created_user');
    }
    public function controlledUser() {
        return $this->belongsTo(User::class, 'controlled_user');
    }

}
