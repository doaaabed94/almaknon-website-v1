<?php
<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $table = 'blog_translations';

    protected $fillable = [
        'blog_id',
        'locale',
        'name',
        'description',
    ];

    public $timestamps = false;
}
