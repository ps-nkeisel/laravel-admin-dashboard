<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adrhead extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adr_head';

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
                  'idcrm',
                  'idsubscription',
                  'idsupport',
                  'idparrent',
                  'idchild',
                  'matchcode',
                  'assign_to',
                  'adr_head_kind_id',
                  'adr_head_branch_id',
                  'adr_head_role_id',
                  'accountnr',
                  'birthday',
                  'comment',

                  'created_user',
                  'created_ip',
                  'updated_user',
                  'updated_ip',
                  'active',
                  'deleted'
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

    /**
     * Get the adrheadkind for this model.
     *
     * @return App\Models\Adrheadkind
     */
    public function adrheadkind()
    {
        return $this->belongsTo(Adrheadkind::class, 'adr_head_kind_id');
    }

    /**
     * Get the adrheadbranch for this model.
     *
     * @return App\Models\Adrheadbranch
     */
    public function adrheadbranch()
    {
        return $this->belongsTo(Adrheadbranch::class, 'adr_head_branch_id');
    }

    /**
     * Get the adrheadrole for this model.
     *
     * @return App\Models\Adrheadrole
     */
    public function adrheadrole()
    {
        return $this->belongsTo(Adrheadrole::class, 'adr_head_role_id');
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

}
