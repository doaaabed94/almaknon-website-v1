<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Attachment;
use Modules\Member\Entities\Traits\Disabable;

class Member extends Model
{
    use Disabable,
        SoftDeletes;

    protected $table = 'mk_member';
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

}
