<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CarController extends Controller
{
  
    public function index()
    {
        return view('frontend::cars.index');
    }



    public function single($slug)
    {
        return view('frontend::cars.details');
    }




    public function search(Request $request)
    {
        //
    }

    
}
