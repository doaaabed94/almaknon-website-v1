<?php

namespace Modules\CMS\Services;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\CMS\Http\Responses\CrudResponse;


class BaseService
{

    public $isApi;
    public function response(int $code = 200, array $data = [], $exception = null, $redirect_url = null)
    {
        if (!$this->isApi) {
            return  new CrudResponse([
                'success'             => isset($data['success']) ? $data['success'] : (($code == 200) ? true : false),
                'type'                => $data['type'] ?? 'toastr',
                'message_type'        => isset($data['success']) ? 'success' : (($code == 200) ? 'success' : 'error'),
                'message_title'       => isset($data['message_title']) ? $data['message_title'] : (($code == 200) ? __('member::strings.save_success.title') : (($code == 500 || $code == 404) ? __('member::strings.error.title') : '')),
                'message_description' => isset($data['message_description']) ? $data['message_description'] : (($code == 200) ? __('member::strings.save_success.description') : (($code == 500 || $code == 404) ? __('member::strings.error.description') : '')),
                'errors'              => [
                    'exception' => $exception ? [
                        'message' => $exception->getMessage(),
                        'code'    => $exception->getCode(),
                        'line'    => $exception->getLine(),
                        'file'    => $exception->getFile(),
                    ] : [],
                ],
                'redirect_url'        => $redirect_url,

            ], $code);
        }
    }
}
