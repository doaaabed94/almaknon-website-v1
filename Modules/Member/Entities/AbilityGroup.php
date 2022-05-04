<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;

class AbilityGroup extends Model
{
    use Translatable,
        TranslatableHelper;

    public $timestamps = false;

    protected $table = 'abilities_groups';

    protected $fillable = [
        'code',
        'icon',
        'base_locale',
    ];

    public $translationModel = 'Modules\Member\Entities\AbilityGroupTranslation';

    public $translatedAttributes = [
        'title',
        'description',
    ];

    public function Abilities()
    {
        return $this->hasMany(Ability::class, 'group_id', 'id');
    }
}
