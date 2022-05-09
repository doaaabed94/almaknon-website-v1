<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class ColorTranslation extends Model
{
    protected $table = 'mk_color_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
