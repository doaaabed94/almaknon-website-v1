<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class FuelTranslation extends Model
{
    protected $table = 'mk_fuel_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
