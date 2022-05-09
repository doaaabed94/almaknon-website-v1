<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class ConditionTranslation extends Model
{
    protected $table = 'mk_condition_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
