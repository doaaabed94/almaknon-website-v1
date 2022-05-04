<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class AbilityGroupTranslation extends Model
{
    protected $table = 'abilities_groups_translations';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'locale',
        'group_id',
    ];
}
