<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Config extends Model
{
    use Disabable,
    SoftDeletes;

}
