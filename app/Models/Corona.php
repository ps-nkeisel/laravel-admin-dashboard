<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Corona extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'corona';

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
        'countrycode',
        'kbr_de',
        'kbr_en',
        'kar_de',
        'kar_en',
        'ever_de',
        'ever_en',
        'ebn_de',
        'ebn_en',
        'ge_de',
        'ge_en',
        'kes_de',
        'kes_en',
        'slu_de',
        'slu_en',
        'sla_de',
        'sla_en',
        'sse_de',
        'sse_en',
        'gla_de',
        'gla_en',
        'fla_de',
        'fla_en',
        'not_de',
        'not_en',
        'eol_de',
        'eol_en',
        'vre_de',
        'vre_en',
        'controlled_at',
        'controlled_user',
        'controlled_ip',
        'created_user',
        'created_ip',
        'updated_user',
        'updated_ip',
        'archive',
        'active',
        'created_at',
        'updated_at'
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
}
