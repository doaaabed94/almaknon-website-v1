<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class CurrencyTranslation extends Model
{
    protected $table = 'mk_currency_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
