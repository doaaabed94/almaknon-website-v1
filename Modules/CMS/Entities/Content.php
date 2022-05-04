<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Content extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'cms_contents';
    
    public $translationModel = 'Modules\CMS\Entities\ContentTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
}
