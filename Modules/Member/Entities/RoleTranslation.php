<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model
{
    protected $table = 'roles_translations';

    protected $fillable = [
        'role_id',
        'locale',
        'title',
        'description'
    ];

    public $timestamps = false;
}
