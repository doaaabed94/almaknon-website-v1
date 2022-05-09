<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Category extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'mk_categories';

    public $translationModel = 'Modules\Maknon\Entities\CategoryTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
}
