<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Validator;
use Exception;
use Bouncer;
use DataTables;
use Carbon\Carbon;

use App\User;
use Modules\Member\Entities\Country;
use Modules\Member\Entities\City;
use Modules\Member\Entities\Role;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\AbilityGroup;
use Modules\Member\Http\Responses\CrudResponse;
use Modules\Member\Http\Exceptions\PermissionsException;
use Modules\TrackAndTrace\Entities\BarcodeRequest;
use Modules\TrackAndTrace\Entities\BarcodeRequestItem;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AdminController extends AdminBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isAn('USER')) {
            return redirect()->back();
        }
        // \Event::fire('AdminController@index:register', [$this->data]);
        // \Event::fire('AdminController@index:boot', [$this->data]);
        // $this->data['CurrentUser'] = $request->user();
        $this->data['NumberOfUser'] = User::where('status', 'active')->where('deleted_at', null)->count();
     
        // $this->data['NumberOfPro'] = Product::where('deleted_at', null)->count();
   
        return view('member::index', $this->data);
    }
}
