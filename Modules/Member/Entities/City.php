<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Modules\Member\Entities\Traits\Disabable;
use Modules\Member\Entities\Country;

class City extends Model
{
    use Translatable,
        TranslatableHelper,
        SoftDeletes,
        Disabable;

    public $timestamps = false;

    protected $fillable = [
        'country_id',
        'native_name',
        'zip_code',
        'lat',
        'lng',
        'base_locale',
        'deleteable',
        'created_by',
        'updated_by',
        'disabled_at',
        'deleted_at',
    ];

    public $translationModel = 'Modules\Member\Entities\CityTranslation';

    public $translatedAttributes = [
        'name',
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
