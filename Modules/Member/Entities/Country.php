<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Modules\Member\Entities\Traits\Disabable;

class Country extends Model
{
    use Translatable,
        TranslatableHelper,
        SoftDeletes,
        Disabable;

    public $timestamps = false;

    protected $fillable = [
        'iso_2',
        'iso_3',
        'dial_code',
        'lat',
        'lng',
        'base_locale',
        'deleteable',
        'created_by',
        'updated_by',
        'disabled_at',
        'deleted_at',
    ];

    public $translationModel = 'Modules\Member\Entities\CountryTranslation';

    public $translatedAttributes = [
        'name',
    ];
}
