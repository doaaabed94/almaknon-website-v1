<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class AbilityTranslation extends Model
{
    protected $table = 'abilities_translations';

    protected $fillable = [
        'ability_id',
        'locale',
        'title',
        'description'
    ];

    public $timestamps = false;
}
