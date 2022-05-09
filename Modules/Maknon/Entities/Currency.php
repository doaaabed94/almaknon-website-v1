<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Currency extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'mk_currencies';
    
    public $translationModel = 'Modules\Maknon\Entities\CurrencyTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
}
