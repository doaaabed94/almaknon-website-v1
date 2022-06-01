<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Frontend\Entities\Newsletter;
use Session;
use Validator;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('frontend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function details()
    {
        return view('frontend::details');
    }

    public function newsletter(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
               'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $enquiry        = new Newsletter;
                $enquiry->name  = $request->input('name');
                $enquiry->email = $request->input('email');
                if (\Request::ip()) {
                    $enquiry->ip_cleint = \Request::ip();
                }

                $enquiry->save();
                Session::flash('status', 'تم إرسال البيانات بنجاح ! شكرا لكم');
                return back();
            }
        } catch (\Exception $e) {
            Session::flash('danger', 'حدث خطأ , نرجو المحاولة مرة اخرى !');
            return back();
        }
    }

}
