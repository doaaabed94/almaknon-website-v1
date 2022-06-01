<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;
use Modules\Member\Entities\Attachment;
use Modules\CMS\Entities\Category;

use Str;

class Content extends Model
{
    use Translatable, 
    TranslatableHelper, 
    Disabable,
    SoftDeletes;

    protected $table = 'cms_contents';
    
    public $translationModel = 'Modules\CMS\Entities\ContentTranslation';
    
    public $translatedAttributes = [
        'name',
        'description',
    ];
   
        public function attachments(){
        return $this->morphMany(Attachment::class,'attachable');
    }


    public function category(){
        return $this->belongsTo(Category::class,'category_id', 'id');
    }


}
