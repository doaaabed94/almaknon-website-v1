<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
  
    public function index()
    {
        return view('frontend::blogs.index');
    }



    public function details($id)
    {
        return view('frontend::blogs.details');
    }



}
