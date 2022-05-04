<?php
namespace Modules\Maknon\Http\Responses;

use Exception;
use Illuminate\Contracts\Support\Responsable;

class CrudResponse implements Responsable
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
        if (request()->ajax()) {
            if (isset($this->data['redirect_url'])) {
                session()->flash('result', $this->data);
            }
            return response()->json($this->data, $this->code);
        }
        if (isset($this->data['redirect_url'])) {
            return redirect()->to( $this->data['redirect_url'] )->withInput()->with('result', $this->data);
        }
        return redirect()->back()->withInput()->with('result', $this->data);
    }
}