<?php

namespace Modules\Maknon\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Maknon\Services\FuelService;
use Modules\Maknon\Entities\Fuel;
use Validator;
use Exception;

class FuelController extends Controller
{

    public $service;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_FUELS')->only(['index', 'postIndex', 'read']);
        $this->middleware('NeedPermissions:CREATE_FUELS')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_FUELS')->only(['update', 'postUpdate']);
        $this->middleware('NeedPermissions:DELETE_FUELS')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_FUELS')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_FUELS')->only(['postPermaDelete']);
        $this->middleware('NeedPermissions:STATUS_UPDATE_FUELS')->only(['postStatus']);

        $this->service = new FuelService();
        $this->validationsRules = $this->service->validationsRules;
        $this->data['model'] = Fuel::query();
    }

    public function index(Request $request)
    {
        $this->data['all_data'] = $this->service->index();
        return view('maknon::fuels.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['locale']                   = $request->locale ? $request->locale : app()->getLocale();
        $this->data['CurrentUser']              = $request->user();
        return view('maknon::fuels.create', $this->data);
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
        
        return view('maknon::fuels.update', $this->data);
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

        return view('maknon::fuels.read', $this->data);
    }
}