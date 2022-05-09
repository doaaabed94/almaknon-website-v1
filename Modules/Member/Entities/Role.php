<?php

namespace Modules\Member\Entities;

use Silber\Bouncer\Database\Role as BaseRole;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;

class Role extends BaseRole
{
    use Translatable,
        TranslatableHelper,
        SoftDeletes;

    protected $fillable = [
        'name',
        'level',
        'scope',
        'deletable',
        'updatable',
        'base_locale',
    ];

    public $translationModel = 'Modules\Member\Entities\RoleTranslation';

    public $translatedAttributes = [
        'title',
        'description',
    ];
}
