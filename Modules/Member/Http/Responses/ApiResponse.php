<?php
namespace Modules\Member\Http\Responses;

use Exception;
use Illuminate\Contracts\Support\Responsable;

class ApiResponse implements Responsable
{
    protected $message    = '';

    protected $hint       = '';

    protected $code       = 200;

    protected $codeString = '001000';

    protected $data       = [];

    /**
     * Create new instances for dependencies.
     *
     * @param $product
     */
    public function __construct($data = [], $code = 200, $message = null)
    {
        $this->message = is_array($message) ? $message['message'] : (is_null($message) ? '' : $message);

        $this->hint    = is_array($message) ? $message['hint']    : '';

        $this->code    = $code;

        $this->data    = $data;
    }
    
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $RESPONSE = [
            'success'   => (bool)   true,
            'code'      => (string) $this->code,
            'message'   => (string) $this->message,
            'hint'      => (string) $this->hint,
            'result'    => null,
            'errors'    => !empty($errors) ? (object) $errors : null
        ];

        if ($this->code == 422) {
            $RESPONSE['success'] = false;
            $RESPONSE['errors']  = array_merge([
                'global' => '',
            ], $this->data);
        }
        else if ($this->code == 423) {
            $RESPONSE['success'] = false;
            $RESPONSE['errors']  = array_merge([
                'global' => '',
            ], $this->data);
        }
        else if ($this->code != 200) {
            $RESPONSE['success'] = false;
            $RESPONSE['errors']  = array_merge([
                'global' => 'unkown_error',
            ], $this->data);
        }
        else {
            $RESPONSE['result'] = array_merge([], $this->data);
        }

        return response()->json($RESPONSE, 200);
    }
}