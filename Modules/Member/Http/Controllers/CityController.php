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
use Modules\Member\Entities\City;
use Modules\Member\Entities\Country;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Member\Http\Controllers\AdminBaseController;

class CityController extends AdminBaseController
{
    public static $validationsRules = [
        'postCreate' => [
            'country'   => 'required|exists:countries,id',
            'locale'    => 'required|max:2',
            'name'      => 'required|max:191',
            'lat'       => 'nullable',
            'lng'       => 'nullable',
        ],
        'postUpdate' => [
            'country'   => 'required|exists:countries,id',
            'locale'    => 'required|max:2',
            'name'      => 'required|max:191',
            'lat'       => 'nullable',
            'lng'       => 'nullable',
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_CITIES')->only(['index', 'postIndex', 'read']);
        $this->middleware('NeedPermissions:CREATE_CITIES')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_CITIES')->only(['update', 'postUpdate']);
        $this->middleware('NeedPermissions:DELETE_CITIES')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_CITIES')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_CITIES')->only(['postPermaDelete']);
        $this->middleware('NeedPermissions:STATUS_UPDATE_CITIES')->only(['postStatus']);
    }

    public function index(Request $request)
    {
        return view('member::cities.index', $this->data);
    }

    public function postIndex(Request $request)
    {
        $this->data['DataTable_Q'] = City::select([
            '*',
        ])
        ->with('translations', 'Country');

        if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES') ) {
            $this->data['DataTable_Q']->withTrashed();
        }
        if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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
            // if (auth()->user()->isAn('ROOT') OR auth()->user()->can('READ_CITIES')) {
            //     $BASE_ACTIONS[] = [
            //         'type'  => 'button',
            //         'icon'  => 'la la-eye',
            //         'label' => __('member::strings.view'),
            //         'link'  => route('CityController@read', ['model' => $Row->id]),
            //     ];
            // }
            if (auth()->user()->isAn('ROOT') OR auth()->user()->can('UPDATE_CITIES')) {
                $BASE_ACTIONS[] = [
                    'type'  => 'button',
                    'icon'  => 'la la-edit',
                    'label' => __('member::strings.update'),
                    'link'  => route('CityController@update', ['model' => $Row->id]),
                ];
            }
            if ( (auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES')) && $Row->trashed() ) {
                if (! empty($BASE_ACTIONS)) {
                    $BASE_ACTIONS[] = [
                        'type'  => 'divider',
                    ];
                }
                $BASE_ACTIONS[] = [
                    'type'    => 'button',
                    'icon'    => 'la la-undo',
                    'label'   => __('member::strings.restore'),
                    'link'    => route('CityController@postRestore', ['model' => $Row->id]),
                    'onclick' => 'CRUD_RESTORE',
                ];
            }
            if ($Row->deleteable == 'Y') {
                if ( (auth()->user()->isAn('ROOT') OR auth()->user()->can('DELETE_CITIES')) && ! $Row->trashed() ) {
                    if (! empty($BASE_ACTIONS)) {
                        $BASE_ACTIONS[] = [
                            'type'  => 'divider',
                        ];
                    }
                    $BASE_ACTIONS[] = [
                        'type'    => 'button',
                        'icon'    => 'la la-trash',
                        'label'   => __('member::strings.delete'),
                        'link'    => route('CityController@postDelete', ['model' => $Row->id]),
                        'onclick' => 'CRUD_DELETE',
                    ];
                }
                if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('PERMA_DELETE_CITIES') ) {
                    $BASE_ACTIONS[] = [
                        'type'    => 'button',
                        'icon'    => 'la la-trash',
                        'iclass'  => 'text-danger',
                        'label'   => __('member::strings.perma_delete'),
                        'link'    => route('CityController@postPermaDelete', ['model' => $Row->id]),
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
        $this->data['Countries']   = Country::with('translations')->get();
        return view('member::cities.create', $this->data);
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
            $this->data['model'] = new City;
            DB::transaction(function() use ($request) {
                if (auth()->user()->isAn('ROOT')) {
                    $this->data['model']->deleteable = in_array($request->deleteable, ['Y', 'N']) ? $request->deleteable : 'Y';
                }
                $this->data['model']->base_locale  = $this->data['locale'];
                $this->data['model']->country_id   = $request->country;
                $this->data['model']->native_name  = $request->latin_name;
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
        $this->data['Countries']   = Country::with('translations')->get();
        try {
            $this->data['model']       = City::with('translations');
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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
        return view('member::cities.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->data['model']       = City::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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

        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postUpdate']
        );
        $this->data['_VALIDATOR_']->validate();

        try {
            DB::transaction(function()use($request){
                if (auth()->user()->isAn('ROOT')) {
                    $this->data['model']->deleteable = in_array($request->deleteable, ['Y', 'N']) ? $request->deleteable : 'Y';
                }
                // $this->data['model']->base_locale  = $this->data['locale'];
                $this->data['model']->native_name  = $request->latin_name;
                $this->data['model']->country_id   = $request->country;
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
            $this->data['model']       = City::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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
            $this->data['model']       = City::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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
            $this->data['model']       = City::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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
            $this->data['model']       = City::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CITIES') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CITIES') ) {
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

    public function ajaxList(Request $request) 
    {
        $this->data['_DATA_']   = [];
        $this->data['_RESULT_'] = [];
        if ($request->country_id) {
            $this->data['_DATA_'] = City::with('translations', 'Country')->has('Country')->where('country_id', $request->country_id)->get();
        }
        foreach ($this->data['_DATA_'] as $key => $value) {
            $this->data['_RESULT_'][] = [
                'value'    => $value->id,
                'text'     => $value->__('name', app()->getLocale()),
                'subText'  => $value->Country->iso_3,
            ];
        }
        return $this->data['_RESULT_'];
    }

    public function read(Request $request)
    {
        return view('member::cities.read', $this->data);
    }
}
