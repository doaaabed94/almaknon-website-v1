<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'cms_category_translations';

    protected $fillable = [
        'category_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
