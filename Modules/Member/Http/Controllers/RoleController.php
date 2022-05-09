<?php

namespace Modules\Member\Http\Controllers;

use Bouncer;
use DB;
use Exception;
use Illuminate\Http\Request;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\AbilityGroup;
use Modules\Member\Entities\Role;
use Modules\Member\Http\Responses\CrudResponse;
use Validator;

class RoleController extends AdminBaseController
{
    public static $validationsRules = [
        'postCreate' => [
            'locale'      => 'nullable',
            'name'        => 'required|unique:roles,name',
            'title'       => 'required|max:191',
            'description' => 'nullable|max:1000',
            'abilities'   => 'nullable|array',
        ],
        'postUpdate' => [
            'locale'      => 'nullable',
            'title'       => 'required|max:191',
            'description' => 'nullable|max:1000',
            'abilities'   => 'nullable|array',
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NeedPermissions:READ_ROLES')->only(['index', 'postIndex', 'read']);
        $this->middleware('NeedPermissions:CREATE_ROLES')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_ROLES')->only(['update', 'postUpdate']);
        $this->middleware('NeedPermissions:DELETE_ROLES')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_ROLES')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_ROLES')->only(['postPermaDelete']);
    }

    public function index(Request $request)
    {
        $this->data['Roles'] = Role::with('translations');
        if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_ROLES')) {
            $this->data['Roles']->withTrashed();
        }
        $this->data['Roles'] = $this->data['Roles']->get();

        return view('member::roles.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['User'] = $request->user()->load('Roles.Abilities');

        $this->data['Ablities_IDS'] = [];

        foreach ($this->data['User']->Roles as $key => $Role) {
            foreach ($Role->Abilities as $key => $Ability) {
                $this->data['Ablities_IDS'][] = $Ability->id;
            }
        }

        $this->data['AbilitiesGroups'] = AbilityGroup::with('translations')
            ->whereHas('Abilities', function ($Abilities) {
                if (!$this->data['User']->isAn('ROOT')) {
                    $Abilities->whereIn(
                        'id', $this->data['Ablities_IDS']
                    );
                }
            })
            ->with([
                'Abilities' => function ($Abilities) {
                    $Abilities->with('translations');
                    if (!$this->data['User']->isAn('ROOT')) {
                        $Abilities->whereIn(
                            'id', $this->data['Ablities_IDS']
                        );
                    }
                },
            ])
            ->get();
        $this->data['locale'] = $request->locale ? $request->locale : app()->getLocale();
        return view('member::roles.add', $this->data);
    }

    public function postCreate(Request $request)
    {
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postCreate']
        )->validate();

        $this->data['User']         = $request->user()->load('Roles.Abilities');
        $this->data['Ablities_IDS'] = [];
        foreach ($this->data['User']->Roles as $key => $Role) {
            foreach ($Role->Abilities as $key => $Ability) {
                $this->data['Ablities_IDS'][] = $Ability->id;
            }
        }
        try {
            $this->data['AbilitiestoAdd'] = is_array($request->abilities) ? $request->abilities : [];
            $this->data['locale']         = $request->locale ? $request->locale : app()->getLocale();

            if ($this->data['User']->isAn('ROOT')) {
                $this->data['Abilities'] = Ability::whereIn('id', $this->data['AbilitiestoAdd'])->get();
            } else {
                $this->data['Abilities'] = Ability::whereIn('id', $this->data['AbilitiestoAdd'])->whereIn('id', $this->data['Ablities_IDS'])->get();
            }
            $this->data['model'] = new Role;
            DB::transaction(function () use ($request) {
                $this->data['model']->base_locale = $this->data['locale'];
                $this->data['model']->name        = $request->name;
                if (is_array($request->title) && is_array($request->description)) {
                    foreach ($request->title as $locale => $title) {
                        if (!empty($request->title[$locale])) {
                            $this->data['model']->{'title:' . $locale}       = $request->title[$locale];
                            $this->data['model']->{'description:' . $locale} = $request->description[$locale];
                        }
                        if (isset($request->image[$locale])) {
                            $PATH                                      = $request->image[$locale]->store('content', 'graph');
                            $this->data['model']->{'image:' . $locale} = $PATH;
                        }
                    }
                } else {
                    $this->data['model']->{'title:' . $this->data['locale']}       = $request->title;
                    $this->data['model']->{'description:' . $this->data['locale']} = $request->description;
                    if ($request->hasFile('image')) {
                        $PATH                                                    = $request->file('image')->store('content', 'graph');
                        $this->data['model']->{'image:' . $this->data['locale']} = $PATH;
                    }
                }
                $this->data['model']->save();
                if ($this->data['User']->isAn('ROOT')) {
                    $this->data['model']->Abilities()->sync(
                        $this->data['Abilities']->pluck('id')->toArray()
                    );
                } else {
                    $this->data['model']->Abilities()->whereIn('id', $this->data['Ablities_IDS'])->sync(
                        $this->data['Abilities']->pluck('id')->toArray()
                    );
                }
            });
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success'             => false,
                    'message_type'        => 'error',
                    'message_title'       => __('member::strings.error.title'),
                    'message_description' => __('member::strings.error.description'),
                    'errors'              => [],
                ], 500);
            }
            return redirect()->back()->withInput()->with('result', [
                'success'             => false,
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [],
            ]);
        }

        if ($request->ajax()) {
            $url = route('member::roles.index');
            return response()->json([
                'success'             => true,
                'type'                => 'toastr',
                'message_type'        => 'success',
                'message_title'       => __('member::strings.save_success.title'),
                'message_description' => __('member::strings.save_success.description'),
                'errors'              => [],
                'redirect_to'         => $url,
            ], 200);
        }
        return redirect()->route('member::roles.update', ['model' => $this->data['model']->id])->with('result', [
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.save_success.title'),
            'message_description' => __('member::strings.save_success.description'),
            'errors'              => [],
        ]);
    }

    public function update(Request $request)
    {
        $this->data['locale'] = $request->locale ? $request->locale : app()->getLocale();

        $this->data['model'] = Role::with('Abilities')->with(['translations'])->findOrFail($request->model);

        $this->data['modelAbilities'] = $this->data['model']->Abilities->pluck('id')->toArray();

        $this->data['User'] = $request->user()->load('Roles.Abilities');

        $this->data['Ablities_IDS'] = [];

        foreach ($this->data['User']->Roles as $key => $Role) {
            foreach ($Role->Abilities as $key => $Ability) {
                $this->data['Ablities_IDS'][] = $Ability->id;
            }
        }

        $this->data['AbilitiesGroups'] = AbilityGroup::with('translations')
            ->whereHas('Abilities', function ($Abilities) {
                if (!$this->data['User']->isAn('ROOT')) {
                    $Abilities->whereIn(
                        'id', $this->data['Ablities_IDS']
                    );
                }
            })
            ->with([
                'Abilities' => function ($Abilities) {
                    $Abilities->with('translations');
                    if (!$this->data['User']->isAn('ROOT')) {
                        $Abilities->whereIn(
                            'id', $this->data['Ablities_IDS']
                        );
                    }
                },
            ])
            ->get();

        return view('member::roles.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postUpdate']
        )->validate();

        $this->data['User']         = $request->user()->load('Roles.Abilities');
        $this->data['Ablities_IDS'] = [];
        foreach ($this->data['User']->Roles as $key => $Role) {
            foreach ($Role->Abilities as $key => $Ability) {
                $this->data['Ablities_IDS'][] = $Ability->id;
            }
        }
        try {
            $this->data['AbilitiestoAdd'] = is_array($request->abilities) ? $request->abilities : [];
            $this->data['locale']         = $request->locale ? $request->locale : app()->getLocale();

            if ($this->data['User']->isAn('ROOT')) {
                $this->data['Abilities'] = Ability::whereIn('id', $this->data['AbilitiestoAdd'])->get();
            } else {
                $this->data['Abilities'] = Ability::whereIn('id', $this->data['AbilitiestoAdd'])->whereIn('id', $this->data['Ablities_IDS'])->get();
            }
            $this->data['model'] = Role::findOrFail($request->model);
            DB::transaction(function () use ($request) {
                if ($request->base_locale) {
                    $this->data['model']->base_locale = $request->base_locale;
                }
                if (is_array($request->title) && is_array($request->description)) {
                    foreach ($request->title as $locale => $title) {
                        if (!empty($request->title[$locale])) {
                            $this->data['model']->{'title:' . $locale}       = $request->title[$locale];
                            $this->data['model']->{'description:' . $locale} = $request->description[$locale];
                        }
                        if (isset($request->image[$locale])) {
                            $PATH                                      = $request->image[$locale]->store('content', 'graph');
                            $this->data['model']->{'image:' . $locale} = $PATH;
                        }
                    }
                } else {
                    $this->data['model']->{'title:' . $this->data['locale']}       = $request->title;
                    $this->data['model']->{'description:' . $this->data['locale']} = $request->description;
                    if ($request->hasFile('image')) {
                        $PATH                                                    = $request->file('image')->store('content', 'graph');
                        $this->data['model']->{'image:' . $this->data['locale']} = $PATH;
                    }
                }
                $this->data['model']->save();
                //Bouncer::sync('SYSTEM_ADMIN')->abilities($this->data['Abilities']->pluck('id')->toArray());

                if ($this->data['User']->isAn('ROOT')) {
                    $this->data['model']->Abilities()->sync(
                        $this->data['Abilities']->pluck('id')->toArray()
                    );
                    Bouncer::sync($this->data['model']->name)->abilities($this->data['Abilities']->pluck('id')->toArray());

                } else if ($this->data['model']->updatable == 1) {
                    $this->data['model']->Abilities()->whereIn('id', $this->data['Ablities_IDS'])->sync(
                        $this->data['Abilities']->pluck('id')->toArray()
                    );
                    Bouncer::sync($this->data['model']->name)->abilities($this->data['Abilities']->pluck('id')->toArray());
                }

                $this->data['model']->save();

            });
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success'             => false,
                    'message_type'        => 'error',
                    'message_title'       => __('member::strings.error.title'),
                    'message_description' => __('member::strings.error.description'),
                    'errors'              => [],
                ], 500);
            }
            return redirect()->back()->withInput()->with('result', [
                'success'             => false,
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [],
            ]);
        }

        if ($request->ajax()) {
            $url = route('member::roles.update', ['model' => $this->data['model']->id]);
            return response()->json([
                'success'             => true,
                'type'                => 'toastr',
                'message_type'        => 'success',
                'message_title'       => __('member::strings.save_success.title'),
                'message_description' => __('member::strings.save_success.description'),
                'errors'              => [],
                'redirect_to'         => $url,
            ], 200);
        }
        return redirect()->route('member::roles.update', ['model' => $this->data['model']->id])->with('result', [
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.save_success.title'),
            'message_description' => __('member::strings.save_success.description'),
            'errors'              => [],
        ]);
    }

    public function postDelete(Request $request)
    {
        try {
            $this->data['model'] = Role::query();
            $this->data['model'] = $this->data['model']->findOrFail($request->model);
        } catch (Exception $e) {
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
                ],
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function () use ($request) {
                $this->data['model']->deleted_by = $request->user()->id;
                $this->data['model']->save();
                $this->data['model']->delete();
            });
        } catch (Exception $e) {
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
                ],
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.delete_success.title'),
            'message_description' => __('member::strings.delete_success.description'),
            'errors'              => [],
        ], 200);
    }

    public function postRestore(Request $request)
    {
        try {
            $this->data['model'] = Role::query();
            if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_ROLES')) {
                $this->data['model']->withTrashed();
            }
            $this->data['model'] = $this->data['model']->findOrFail($request->model);
        } catch (Exception $e) {
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
                ],
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function () use ($request) {
                $this->data['model']->restore();
            });
        } catch (Exception $e) {
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
                ],
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.restore_success.title'),
            'message_description' => __('member::strings.restore_success.description'),
            'errors'              => [],
        ], 200);
    }

    public function postPermaDelete(Request $request)
    {
        try {
            $this->data['model'] = Role::query();
            if (auth()->user()->isAn('ROOT') or auth()->user()->can('RESTORE_ROLES')) {
                $this->data['model']->withTrashed();
            }
            // if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_ROLES') ) {
            //     $this->data['model']->withDisabled();
            // }
            $this->data['model'] = $this->data['model']->findOrFail($request->model);
        } catch (Exception $e) {
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
                ],
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function () use ($request) {
                $this->data['model']->forceDelete();
            });
        } catch (Exception $e) {
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
                ],
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.perma_delete_success.title'),
            'message_description' => __('member::strings.perma_delete_success.description'),
            'errors'              => [],
        ], 200);
    }

    public function postStatus(Request $request)
    {

    }

    public function read(Request $request)
    {
        return view('member::roles.read', $this->data);
    }
}
