<?php

namespace Modules\Maknon\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Maknon\Services\CarService;
use Modules\Maknon\Entities\Car;

use Modules\Maknon\Entities\Condition;
use Modules\Maknon\Entities\Fuel;
use Modules\Maknon\Entities\Marka;
use Modules\Maknon\Entities\Offer;
use Modules\Member\Entities\Country;

use Validator;
use Exception;

class CarController extends Controller
{

    public $service;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_CARS')->only(['index', 'postIndex', 'read']);
        $this->middleware('NeedPermissions:CREATE_CARS')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_CARS')->only(['update', 'postUpdate']);
        $this->middleware('NeedPermissions:DELETE_CARS')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_CARS')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_CARS')->only(['postPermaDelete']);
        $this->middleware('NeedPermissions:STATUS_UPDATE_CARS')->only(['postStatus']);

        $this->service = new CarService();
        $this->validationsRules = $this->service->validationsRules;
        $this->data['model'] = Car::query();
    }

    public function index(Request $request)
    {
        $this->data['all_data'] = $this->service->index();
        return view('maknon::cars.index', $this->data);
    }

    public function create(Request $request)
    {   
        $this->data['locale']                   = $request->locale ? $request->locale : app()->getLocale();
        $this->data['markas']                   = Marka::with('translations')->get();
        $this->data['conditions']               = Condition::with('translations')->get();
        $this->data['fuels']                    = Fuel::with('translations')->get();
        $this->data['offers']                   = Offer::with('translations')->get();
        $this->data['currencies']               = Offer::with('translations')->get();
        $this->data['Countries']                = Country::with('translations')->get();

        $this->data['CurrentUser']              = $request->user();
        return view('maknon::cars.create', $this->data);
    }

    public function postCreate(Request $request)
    {
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(),
            $this->validationsRules['postCreate']
        );
      
        $this->data['_VALIDATOR_']->after(function ($_VALIDATOR_) use ($request) {

            if (empty($request->name)) {
                $_VALIDATOR_->errors()->add('name.ar', __('member::strings.please_enter_the_data_at_least_in_one_language'));

            } else if (is_array($request->name)) {
                $HAS_ERROR = true;
                foreach ($request->name as $locale => $value) {
                    if (!empty($value)) {
                        $HAS_ERROR = false;
                    }
                }
                if ($HAS_ERROR) {
                    $_VALIDATOR_->errors()->add('name.ar', __('member::strings.please_enter_the_data_at_least_in_one_language'));
                }
            }
        });
        $this->data['_VALIDATOR_']->validate();
        try {
            return DB::transaction(function () use ($request) {
                return $this->service->store($request->all());
            });
        } catch (Exception $e) {
                return $this->service->response(500, [], $e);
        }
    }

    public function update(Request $request)
    {
        $this->data['CurrentUser']  = $request->user();
        $this->data['locale']       = $request->locale ? $request->locale : app()->getLocale();
        if (!$this->data['data'] = $this->service->getModel($request->model))
            return $this->service->response(404);
        
        return view('maknon::cars.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(),
            $this->validationsRules['postUpdate']
        );
        $this->data['_VALIDATOR_']->validate();

        $this->data['_VALIDATOR_']->after(function ($_VALIDATOR_) use ($request) {
            if (empty($request->name)) {
                $_VALIDATOR_->errors()->add('name.ar', __('member::strings.please_enter_the_data_at_least_in_one_language'));

            } else if (is_array($request->name)) {
                $HAS_ERROR = true;
                foreach ($request->name as $locale => $value) {
                    if (!empty($value)) {
                        $HAS_ERROR = false;
                    }
                }
                if ($HAS_ERROR) {
                    $_VALIDATOR_->errors()->add('name.ar', __('member::strings.please_enter_the_data_at_least_in_one_language'));
                }
            }
        });
        $this->data['_VALIDATOR_']->validate();

        try {
            return DB::transaction(function () use ($request) {
              return $this->service->update($request->model, $request->all());
            });
        } catch (Exception $e) {
            return $this->service->response(500, [], $e);
        }
    }

    public function postDelete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return $this->service->delete($request->model);
            });
        } catch (Exception $e) {
            return $this->service->response(500, [], $e);
        }
    }

    public function postRestore(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return $this->service->restore($request->model);
            });
        } catch (Exception $e) {
            return $this->service->response(500, [], $e);
        }
    }


    public function postPermaDelete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return $this->service->forceDelete($request->model);
            });
        } catch (Exception $e) {
            return $this->service->response(500, [], $e);
        }
    }

    public function postStatus(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return $this->service->status($request->model);
            });
        } catch (Exception $e) {
            return $this->service->response(500, [], $e);
        }
    }

    public function read(Request $request)
    {
        if (!$this->data['model'] = $this->service->getModel($request->model, 'translations'))
            return $this->service->response(404);

        return view('maknon::cars.read', $this->data);
    }
}
