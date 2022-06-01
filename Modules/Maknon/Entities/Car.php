<?php

namespace Modules\Maknon\Entities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Member\Entities\Traits\TranslatableHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;
use Modules\Member\Entities\Attachment;
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

        public function attachments(){
        return $this->morphMany(Attachment::class,'attachable');
    }


    public function Marka()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Marka' , 'marka_id' , 'id');
    }
    public function fuel()
    {
        return $this->belongsTo('Modules\Maknon\Entities\fuel' , 'fuel_id' , 'id');
    }

      public function Offer()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Offer' , 'offer_id' , 'id');
    }


      public function Currency()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Currency' , 'currency_id' , 'id');
    }

      public function Color()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Color' , 'color_id' , 'id');
    }

         public function Condition()
    {
        return $this->belongsTo('Modules\Maknon\Entities\Condition' , 'condition_id' , 'id');
    }
}
