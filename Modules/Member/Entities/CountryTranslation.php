<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    protected $table = 'country_translations';

    protected $fillable = [
        'country_id',
        'locale',
        'name',
    ];

    public $timestamps = false;
}
