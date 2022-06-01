<?php

namespace Modules\CMS\Entities\Traits;
/**
 *
 */
trait Helpers
{
    public static $DateParser = null;

    public function getImageByDifferentField($model,$field = 'image',$size = '85x85',$default = 'general'){
        // // This means that the image is not actually stored internaly but rather externally.
        // if(Str::startsWith($model->{$field}, 'http')){
        //     return $model->{$field};
        // }
        $translatedField = $model->{$field};

        if(is_null($translatedField))
        {
            foreach (\LaravelLocalization::getLocalesOrder() as $locale => $lang) {
                if(array_key_exists($field.'_'.$locale, $model->getAttributes()) && !empty($model->{$field.'_'.$locale}))
                {
                    $translatedField = $model->{$field.'_'.$locale};
                    break;
                }
            }
        }
        return ($translatedField)
        ? route('image', ['size' => $size, 'path' => $translatedField])
        : route('image', ['size' => $size, 'path' => 'defaults/general.png']);
    }

    public static function parseDate($data, $format = 'l dS F Y h:i A', $limit = null)
    {
        if (is_null(static::$DateParser)) {
            include_once base_path("Modules/CMS/Includes/date/I18N/Arabic.php");

            static::$DateParser = (new \I18N_Arabic('Date'))->setMode(4);
        }

        $return = (app()->getLocale() == 'ar')
        ? static::$DateParser->date($format, strtotime($data))
        : \Carbon\Carbon::parse($data)->format($format);

        // $return = \Carbon\Carbon::parse($data)->format('Y/m/d - الساعة: H:i');

        if (!is_null($limit)) {
            if ($format == 'F' && app()->getLocale() == 'en') {
                $return = substr($return, 0, $limit);
            }
        }
        return $return;
    }
}
