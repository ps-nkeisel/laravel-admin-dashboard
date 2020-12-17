<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adrheadbranch extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adr_head_branch';

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
                  'content_de',
                  'content_en',
                  'created_user',
                  'created_ip',
                  'updated_user',
                  'updated_ip',
                  'active'
              ];

    protected $appends = [
                'created_username',
                'updated_username',
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

}
