<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class SubContentTranslation extends Model
{
    protected $table = 'cms_sub_category_translations';

    protected $fillable = [
        'sub_content_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
