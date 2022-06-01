<?php
namespace Modules\Member\Classes;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class ResponseHandler implements Responsable
{
    protected $code = 200;

    protected $data = [];

    /**
     * Create new instances for dependencies.
     *
     * @param $product
     */
    public function __construct($data = [], $code = 200)
    {
        $this->code = $code;

        $this->data = $data;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        if($request->ajax())
        {
            return response()->json($this->data, $this->code);
        }

        if(isset($this->data['redirect_url']))
        {
            $response =  redirect(url($this->data['redirect_url']))->with('toastr', $this->data);

            return $response;
        }

        $response = redirect()->back()->with('toastr', $this->data);

        if($this->code != 200)
        {
            $response = $response->withInput();
        }

        return $response;
    }
}
