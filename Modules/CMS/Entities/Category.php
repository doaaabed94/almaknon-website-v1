<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Category extends Model
{
    use Translatable, 
    Disabable,
    TranslatableHelper, 
    SoftDeletes;

    protected $table = 'cms_categories';
    
    public $translationModel = 'Modules\CMS\Entities\CategoryTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
}
