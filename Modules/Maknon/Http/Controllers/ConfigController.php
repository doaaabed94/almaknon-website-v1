<?php

namespace Modules\Maknon\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Maknon\Services\ConfigService;
use Modules\Maknon\Entities\Config;
use Validator;
use Exception;

class ConfigController extends Controller
{

    public $service;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_CONFIG')->only(['index',  'read']);
        $this->middleware('NeedPermissions:CREATE_CONFIG')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_CONFIG')->only(['update', 'postIndex']);
        $this->middleware('NeedPermissions:DELETE_CONFIG')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_CONFIG')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_CONFIG')->only(['postPermaDelete']);
        $this->middleware('NeedPermissions:STATUS_UPDATE_CONFIG')->only(['postStatus']);

        $this->service = new ConfigService();
        $this->validationsRules = $this->service->validationsRules;
        $this->data['model'] = Config::query();
    }

    public function index(Request $request)
    {
        $this->data['all_data'] = $this->service->index();
        return view('maknon::configs.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['locale']                   = $request->locale ? $request->locale : app()->getLocale();
        $this->data['CurrentUser']              = $request->user();
        return view('maknon::configs.create', $this->data);
    }

    public function postCreate(Request $request)
    {
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(),
            $this->validationsRules['postCreate']
        );
      
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
        
        return view('maknon::configs.update', $this->data);
    }

    public function postIndex(Request $request)
    {
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(),
            $this->validationsRules['postUpdate']
        );
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
        if (!$this->data['model'] = $this->service->getModel($request->model))
            return $this->service->response(404);

        return view('maknon::configs.read', $this->data);
    }
}
