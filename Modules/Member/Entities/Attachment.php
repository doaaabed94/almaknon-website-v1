<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Storage;

class Attachment extends Model
{
    protected $table = 'attachments';

    protected $guarded = [];

    protected $appends = ['url'];

    protected static $imageOptions = [
        'dimensions' => [
            '60x30',
            '75x75',
            '85x85',
            '150x150',
            '165x130',
            '180x180',
            '192x128',
            '420x700',
            '800x400',
            '1000x750',
            '1150x700',
            '1150x598',
            '1920x1079',
            '1920x1280',
            '1200x848',
            '1920x600'
        ],
    ];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->uid);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($attachment){
            // delete associated file from storage
            Storage::disk('public')->delete($attachment->uid);
        });
    }

    public function getUid($size = '85x85'){
        // This means that the image is not actually stored internaly but rather externally.
        if(Str::startsWith($this->uid, 'http')){
            return $this->uid;
        }

        if(! self::imageDimensions()->contains($size) && $size != 'original'){
            return route('image', ['size' => $size, 'path' => 'not_found.png']);
        }

        return ($this->uid)
        ? route('image', ['size' => $size, 'path' => $this->uid])
        : route('image', [
            'size' => $size,
            'path' => 'defaults/attachments.png'
        ]);
    }

    public static function imageDimensions(){
        return collect(self::$imageOptions['dimensions']);
    }

    public function getThumbnail($size = '85x85')
    {
        return ($this->uid)
        ? route('image', ['size' => $size, 'path' => $this->uid])
        : route('image', ['size' => $size, 'path' => 'defaults/attachements.png']);
    }

}
