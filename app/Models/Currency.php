<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'currency';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'base',
        'target',
        'rate',
        'refresh',
    ];

    protected $appends = [
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


}
