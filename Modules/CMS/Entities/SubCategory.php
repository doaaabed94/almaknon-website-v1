<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class SubContent extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'cms_sub_categories';
    
    public $translationModel = 'Modules\CMS\Entities\SubContentTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
}
