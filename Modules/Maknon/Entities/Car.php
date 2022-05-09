<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Car extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'mk_cars';

    protected $fillable = [
        'image',
        'type',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'disabled_by',
        'created_at',
        'updated_at',
        'disabled_at',
        'deleted_at',
    ];

    public $translationModel = 'Modules\Maknon\Entities\CarTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
}
