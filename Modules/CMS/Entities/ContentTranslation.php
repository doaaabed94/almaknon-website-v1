<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ContentTranslation extends Model
{
    protected $table = 'cms_content_translations';

    protected $fillable = [
        'content_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
