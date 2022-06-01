<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Content;

class BlogController extends Controller
{

    public function index()
    {   

        $data['models'] =  Content::whereIn('category_id',['10','11'] )->translatedIn(app()->getLocale())->with('translations','attachments')->orderby('created_at', 'DESC')->take(6)->get();
        return view('frontend::blogs.index')->with($data);
    }

    public function single($slug)
    {
        $this->data['model'] = Content::where('slug', $slug)->with(['translations','attachments'])->first();
        if($this->data['model']){
        return view('frontend::blogs.details', $this->data);

        }else{
            return view('frontend::blogs.index', $this->data);
        }
    }

    public function general($slug)
    {   
         $this->data['model'] = Content::where('slug', $slug)->with('translations','attachments')->get();
        dd($this->data['model']);
        return view('frontend::blogs.details', $this->data);
    }

}
