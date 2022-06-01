<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;

class Evaluation extends Model
{
    use Disabable,
        SoftDeletes;

    protected $table = 'mk_evaluation_car';

    public function Member()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Member', 'member_id', 'id');
    }

    public function Car()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Car', 'car_id', 'id');
    }

}
