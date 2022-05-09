<?php

namespace Modules\Member\Http\Controllers;

use DB;
use Hash;
use Validator;
use Exception;
use Bouncer;
use DataTables;
use Carbon\Carbon;

use Modules\Member\Http\Responses\CrudResponse;
use Modules\Member\Http\Exceptions\PermissionsException;
use Modules\Member\Entities\Config;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Member\Http\Controllers\AdminBaseController;

class ConfigController extends AdminBaseController
{
    public static $validationsRules = [
        'postCreate' => [
        ],
        'postUpdate' => [
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_CONFIG')->only(['index', 'postIndex', 'read', 'update']);
        $this->middleware('NeedPermissions:UPDATE_CONFIG')->only(['postUpdate']);
    }

    public function read(Request $request)
    {
        return view('member::config.read', $this->data);
    }

    public function update(Request $request)
    {
        $this->data['configs'] = Config::get();
        return view('member::config.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        try {
            DB::transaction(function() use($request) {
                $CONFIGS = is_array($request->config) ? $request->config : [];
                Config::query()->delete();
                foreach ($CONFIGS as $key => $CONFIG) {
                    if (!empty($key)) {
                        Config::create([
                            'tag'       => 'GENERAL',
                            'key'       => $key,
                            'key_value' => empty($CONFIG) ? null : $CONFIG,
                        ]);
                    }
                }
            });
        } 
        catch(PermissionsException $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.permissions_error.title'),
                'message_description' => __('member::strings.permissions_error.description'),
                'errors'              => []
            ], 500);
        }
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.save_success.title'),
            'message_description' => __('member::strings.save_success.description'),
            'errors'              => [],
        ], 200);
    }
}
