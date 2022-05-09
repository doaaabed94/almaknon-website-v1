<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Condition extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'mk_conditions';
    
    public $translationModel = 'Modules\Maknon\Entities\ConditionTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
}
