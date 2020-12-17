<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Useraction extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'useractions';

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
                  'assigntonew',
                  'assigntoold',
                  'assigntype',
                  'comment',
                  'created_ip',
                  'created_user',
                  'type',
                  'lang',
                  'version',
                  'destination',
                  'code',
              ];

    protected $appends = [
        'created_username',
        'section_name',
        'type_name',
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
        $result = Carbon::parse($value);
        return $result ? $result->format('j/n/Y g:i A') : '';
    }

    public function createdUser() {
        return $this->belongsTo(User::class, 'created_user');
    }
    public function getCreatedUsernameAttribute() {
        return $this->createdUser ? $this->createdUser->name : '';
    }

    public function useractionsection() {
        return $this->belongsTo(Useractionsection::class, 'assigntype');
    }
    public function getSectionNameAttribute() {
        return $this->useractionsection ? $this->useractionsection->content : '';
    }

    public function useractiontype() {
        return $this->belongsTo(Useractiontype::class, 'type');
    }
    public function getTypeNameAttribute() {
        return $this->useractiontype ? $this->useractiontype->content : '';
    }
    public function language() {
        return $this->belongsTo(Language::class, 'lang');
    }

    public function getLanguageContentAttribute() {
        return $this->language ? $this->language->content : '';
    }
}
