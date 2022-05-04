<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class MarkaTranslation extends Model
{
    protected $table = 'mk_marka_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
