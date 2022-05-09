<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class CarTranslation extends Model
{
    protected $table = 'mk_car_translations';

    protected $fillable = [
        'blog_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
