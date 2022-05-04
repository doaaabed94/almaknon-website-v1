<?php

namespace Modules\Member\Entities;

use Silber\Bouncer\Database\Ability as BaseAbility;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;

class Ability extends BaseAbility
{
    use Translatable, 
        TranslatableHelper;

    protected $fillable = [
        'name',
        'group_id',
        'entity_id',
        'entity_type',
        'only_owned',
        'scope',
        'base_locale',
    ];

    public $translationModel = 'Modules\Member\Entities\AbilityTranslation';

    public $translatedAttributes = [
        'title',
        'description',
    ];

    public Function Group()
    {
        return $this->belongsTo(AbilityGroup::class, 'group_id', 'id');
    }
}
