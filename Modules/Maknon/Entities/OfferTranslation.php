<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class OfferTranslation extends Model
{
    protected $table = 'mk_offer_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
