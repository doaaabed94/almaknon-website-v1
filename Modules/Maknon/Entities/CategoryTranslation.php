<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'mk_category_translations';

    protected $fillable = [
        'language_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
