<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Routing\Controller;

class VisitorController extends Controller
{

    public function login()
    {
        return view('frontend::users.login', $this->data);
    }

    public function PostLogin()
    {
        return view('frontend::users.login', $this->data);
    }

    public function favorite()
    {
        return view('frontend::users.favorite', $this->data);
    }

    public function PostFavorite()
    {
        return view('frontend::users.favorite', $this->data);
    }

    public function PostRegister()
    {
        return view('frontend::users.register', $this->data);
    }

    public function register()
    {
        return view('frontend::users.register', $this->data);
    }
}
