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
use Modules\Member\Entities\Country;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Member\Http\Controllers\AdminBaseController;

class CountryController extends AdminBaseController
{
    public static $validationsRules = [
        'postCreate' => [
            'dial_code' => 'required|max:191',
            'iso_2'     => 'required|max:2|unique:countries,iso_2',
            'iso_3'     => 'required|max:3|unique:countries,iso_3',
            'locale'    => 'required|max:2',
            'name'      => 'required|max:191',
            'lat'       => 'nullable',
            'lng'       => 'nullable',
        ],
        'postUpdate' => [
            'dial_code' => 'required|max:191',
            'iso_2'     => 'required|max:2|unique:countries,iso_2',
            'iso_3'     => 'required|max:3|unique:countries,iso_3',
            'locale'    => 'required|max:2',
            'name'      => 'required|max:191',
            'lat'       => 'nullable',
            'lng'       => 'nullable',
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_COUNTRIES')->only(['index', 'postIndex', 'read']);
        $this->middleware('NeedPermissions:CREATE_COUNTRIES')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_COUNTRIES')->only(['update', 'postUpdate']);
        $this->middleware('NeedPermissions:DELETE_COUNTRIES')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_COUNTRIES')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_COUNTRIES')->only(['postPermaDelete']);
        $this->middleware('NeedPermissions:STATUS_UPDATE_COUNTRIES')->only(['postStatus']);
    }

    public function index(Request $request)
    {
        $this->data['rows'] = Country::paginate(25);
        
        return view('member::countries.index', $this->data);
    }

    public function postIndex(Request $request)
    {
        $this->data['DataTable_Q'] = Country::select([
            '*',
        ])
        ->with('translations');

        if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES') ) {
            $this->data['DataTable_Q']->withTrashed();
        }
        if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
            $this->data['DataTable_Q']->withDisabled();
        }

        if (!empty( $request->search['value'] )) {
            $this->data['DataTable_Q']->where(function($Q)use($request){
                $Q->whereHas('translations', function($translations)use($request){
                    $translations->where('name', 'like', "%{$request->search['value']}%");
                });
            });
        }

        // $this->data['DataTable_Q']->AdvancedSearch($request->advanced_search);
        
        return DataTables::of(
            $this->data['DataTable_Q']
        )
        ->addColumn('translations', function($Row){
            $DATA = [];
            foreach ($Row->translations as $key => $Translation) {
                $DATA[ $Translation->locale ] = $Translation->toArray();
            }
            return $DATA;
        })
        ->addColumn('actions', function($Row){
            $DATA         = [];
            $BASE_ACTIONS = [];
            // if (auth()->user()->isAn('ROOT') OR auth()->user()->can('READ_COUNTRIES')) {
            //     $BASE_ACTIONS[] = [
            //         'type'  => 'button',
            //         'icon'  => 'la la-eye',
            //         'label' => __('member::strings.view'),
            //         'link'  => route('CountryController@read', ['model' => $Row->id]),
            //     ];
            // }
            if (auth()->user()->isAn('ROOT') OR auth()->user()->can('UPDATE_COUNTRIES')) {
                $BASE_ACTIONS[] = [
                    'type'  => 'button',
                    'icon'  => 'la la-edit',
                    'label' => __('member::strings.update'),
                    'link'  => route('CountryController@update', ['model' => $Row->id]),
                ];
            }
            if ( (auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES')) && $Row->trashed() ) {
                if (! empty($BASE_ACTIONS)) {
                    $BASE_ACTIONS[] = [
                        'type'  => 'divider',
                    ];
                }
                $BASE_ACTIONS[] = [
                    'type'    => 'button',
                    'icon'    => 'la la-undo',
                    'label'   => __('member::strings.restore'),
                    'link'    => route('CountryController@postRestore', ['model' => $Row->id]),
                    'onclick' => 'CRUD_RESTORE',
                ];
            }
            if ($Row->deleteable == 'Y') {
                if ( (auth()->user()->isAn('ROOT') OR auth()->user()->can('DELETE_COUNTRIES')) && ! $Row->trashed() ) {
                    if (! empty($BASE_ACTIONS)) {
                        $BASE_ACTIONS[] = [
                            'type'  => 'divider',
                        ];
                    }
                    $BASE_ACTIONS[] = [
                        'type'    => 'button',
                        'icon'    => 'la la-trash',
                        'label'   => __('member::strings.delete'),
                        'link'    => route('CountryController@postDelete', ['model' => $Row->id]),
                        'onclick' => 'CRUD_DELETE',
                    ];
                }
                if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('PERMA_DELETE_COUNTRIES') ) {
                    $BASE_ACTIONS[] = [
                        'type'    => 'button',
                        'icon'    => 'la la-trash',
                        'iclass'  => 'text-danger',
                        'label'   => __('member::strings.perma_delete'),
                        'link'    => route('CountryController@postPermaDelete', ['model' => $Row->id]),
                        'onclick' => 'CRUD_PERMA_DELETE',
                    ];
                }
            }
            if (! empty($BASE_ACTIONS)) {
                $DATA[] = [
                    'type'  => 'dropdown',
                    'icon'  => 'la la-gear',
                    'items' => $BASE_ACTIONS,
                ];
            }
            return $DATA;
        })
        ->toJson();
    }

    public function create(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['CurrentUser'] = $request->user();
        return view('member::countries.create', $this->data);
    }

    public function postCreate(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['CurrentUser'] = $request->user();
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postCreate']
        );
        $this->data['_VALIDATOR_']->validate();

        try {
            $this->data['model'] = new Country;
            DB::transaction(function() use ($request) {
                if (auth()->user()->isAn('ROOT')) {
                    $this->data['model']->deleteable = in_array($request->deleteable, ['Y', 'N']) ? $request->deleteable : 'Y';
                }
                $this->data['model']->iso_2        = $request->iso_2;
                $this->data['model']->iso_3        = $request->iso_3;
                $this->data['model']->dial_code    = $request->dial_code;
                $this->data['model']->base_locale  = $this->data['locale'];
                $this->data['model']->lat          = $request->lat;
                $this->data['model']->lng          = $request->lng;
                $this->data['model']->{'name:' . $this->data['locale']} = $request->name;
                $this->data['model']->created_by   = $this->data['CurrentUser']->id;
                $this->data['model']->save();
            });
        } 
        catch (Exception $e) {
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
            'errors'              => []
        ], 200);
    }

    public function update(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['CurrentUser'] = $request->user();
        try {
            $this->data['model']       = Country::with('translations');
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
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
            ], 404);
        }
        return view('member::countries.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->data['model']       = Country::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
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
            ], 404);
        }

        $this->data['CurrentUser'] = $request->user();
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();

        static::$validationsRules['postUpdate']['iso_2'] = static::$validationsRules['postUpdate']['iso_2'] . ',' . $this->data['model']->id;
        static::$validationsRules['postUpdate']['iso_3'] = static::$validationsRules['postUpdate']['iso_3'] . ',' . $this->data['model']->id;
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postUpdate']
        );
        $this->data['_VALIDATOR_']->validate();

        try {
            DB::transaction(function()use($request){
                if (auth()->user()->isAn('ROOT')) {
                    $this->data['model']->deleteable = in_array($request->deleteable, ['Y', 'N']) ? $request->deleteable : 'Y';
                }
                $this->data['model']->iso_2        = $request->iso_2;
                $this->data['model']->iso_3        = $request->iso_3;
                $this->data['model']->dial_code    = $request->dial_code;
                // $this->data['model']->base_locale  = $this->data['locale'];
                $this->data['model']->lat          = $request->lat;
                $this->data['model']->lng          = $request->lng;
                $this->data['model']->{'name:' . $this->data['locale']} = $request->name;
                $this->data['model']->updated_by   = $this->data['CurrentUser']->id;
                $this->data['model']->save();
            });
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
            'errors'              => []
        ], 200);
    }

    public function postDelete(Request $request)
    {
        try {
            $this->data['model']       = Country::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
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
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->deleted_by = $this->data['CurrentUser']->id;
                $this->data['model']->delete();
            });
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
            'message_title'       => __('member::strings.delete_success.title'),
            'message_description' => __('member::strings.delete_success.description'),
            'errors'              => []
        ], 200);
    }

    public function postRestore(Request $request)
    {
        try {
            $this->data['model']       = Country::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
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
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->restore();
            });
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
            'message_title'       => __('member::strings.restore_success.title'),
            'message_description' => __('member::strings.restore_success.description'),
            'errors'              => []
        ], 200);
    }

    public function postPermaDelete(Request $request)
    {
        try {
            $this->data['model']       = Country::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
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
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->forceDelete();
            });
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
            'message_title'       => __('member::strings.perma_delete_success.title'),
            'message_description' => __('member::strings.perma_delete_success.description'),
            'errors'              => []
        ], 200);
    }

    public function postStatus(Request $request)
    {
        try {
            $this->data['model']       = Country::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_COUNTRIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_COUNTRIES') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
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
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->updated_by = $this->data['CurrentUser']->id;
                if ($this->data['model']->isDisabled()) {
                    $this->data['model']->enable();
                }
                else if ($this->data['model']->isEnabled()) {
                    $this->data['model']->disable();
                }
            });
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
            'errors'              => []
        ], 200);
    }

    public function read(Request $request)
    {
        return view('member::countries.read', $this->data);
    }
}
