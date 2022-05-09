<?php

namespace Modules\Member\Http\Traits;
/**
 *
 */

use Exception;
use Validator;
use Carbon\Carbon;
use GeniusTS\HijriDate\Hijri;

class Helpers
{
    public static $DateParser = null;

    public $module            = 'Admin';

    public $exception         = null;

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
            include_once base_path("Modules/Admin/Classes/Date/I18N/Arabic.php");

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

    public function module(string $module)
    {
        $this->module = strtolower($module);

        return $this;
    }

    public function exception(Exception $e)
    {
        $this->exception = $e;

        return $this;
    }

    public function sendSuccessResponse($key = 'processed_successfully', $result = [], $code = '200')
    {
        $response = [
            'success'   => true,
            'code'      => $code,
            'message'   => __($this->module . '::api.response_messages.'.$key.'.message'),
            'hint'      => __($this->module . '::api.response_messages.'.$key.'.hint'),
            'result'    => !empty($result) ? (object) $result : null,
            'errors'    => null
        ];

        return response()->json($response, 200);
    }

    public function sendFailResponse($key = 'something_went_wrong', $errors = [], $code = '500')
    {
        \Log::debug([
            'request'   => request()->all(),
            'exception' => $this->exception ? $this->exception->getMessage() . ' [Line: ' . $this->exception->getLine() . ' - File: '. $this->exception->getFile() .']' : null,
            'module'    => $this->module,
            'key'       => $key,
            'errors'    => $errors,
        ]);

        $response = [
            'success'   => false,
            'code'      => $code,
            'message'   => __($this->module . '::api.response_messages.'.$key.'.message'),
            'hint'      => __($this->module . '::api.response_messages.'.$key.'.hint'),
            'result'    => null,
            'errors'    => !empty($errors) ? (object) $errors : null
        ];

        if(env('APP_ENV') == 'development' && env('APP_DEBUG') && $this->exception) $response['exception'] = $this->exception->getMessage() . ' [Line: ' . $this->exception->getLine() . ' - File: '. $this->exception->getFile() .']';
        if(env('APP_ENV') == 'local'       && env('APP_DEBUG') && $this->exception) $response['exception'] = $this->exception->getMessage() . ' [Line: ' . $this->exception->getLine() . ' - File: '. $this->exception->getFile() .']';

        $this->exception = null;

        return response()->json($response, 200);
    }

    public function checkRemovability($model)
    {
        switch (true) {
            case $model instanceof User:
                // Add condition to prevent the user from proceeding.
                return true;
                break;
        }

        $this->sendFailResponse('forbidden', [], '422');
    }

    public function validationErrors($validator)
    {
        $messages = $validator->messages()->toArray();

        $validationErrorMessages = [];

        foreach($messages as $key => $value) {
            $validationErrorMessages[] = [
                'field'     => $key,
                'message'   => $value[0]
            ];
        }

        return $validationErrorMessages;
    }

    public function dateParse($FromType, $TypeFormatedDate)
    {
        $Result = [
            'HIJRI'     => null,
            'GREGORIAN' => null,
        ];
        if ($FromType == 'GREGORIAN') {
            $Result['GREGORIAN'] = Carbon::parse($TypeFormatedDate);
            $Result['HIJRI']     = Hijri::convertToHijri($Result['GREGORIAN']);
        }
        else if ($FromType == 'HIJRI') {
            $Result['HIJRI']     = Carbon::parse($TypeFormatedDate);
            $Result['GREGORIAN'] = Hijri::convertToGregorian($Result['HIJRI']->day, $Result['HIJRI']->month, $Result['HIJRI']->year);
        }
        return $Result;
    }
}
