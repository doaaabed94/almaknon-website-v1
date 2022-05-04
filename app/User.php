<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Member\Entities\Traits\Disabable;
use Modules\Member\Entities\Traits\ModelExtenstion;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use Notifiable,
        SoftDeletes,
        Disabable,
        HasRolesAndAbilities,
        ModelExtenstion;

    protected static $withRegisteredScope = false; 

    protected static $withVerifiedScope   = false; 

    protected $customJwtClaims = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'username', 'phone_number', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    // public function setCustomJwtClaims(array $claims)
    // {
    //     $this->customJwtClaims = array_merge($this->customJwtClaims, $claims);
    // }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    // public function getJWTCustomClaims()
    // {
    //     return $this->customJwtClaims;
    // }


    public function scopeSearch($query, $Filter, $Preffix = '')
    {
        if (!empty($Filter)) {
            $query->where(function($query)use($Filter){
                $query->where(  $Preffix . 'username'     , 'like', "%{$Filter}%");
                $query->orWhere($Preffix . 'email'        , 'like', "%{$Filter}%");
                $query->orWhere($Preffix . 'phone_number' , 'like', "%{$Filter}%");
                $query->orWhere($Preffix . 'first_name'   , 'like', "%{$Filter}%");
                $query->orWhere($Preffix . 'last_name'    , 'like', "%{$Filter}%");
            });
        }
        return $query;
    }

    public function scopeAdvancedSearch($query, $Filter, $Preffix = '')
    {
        if (is_array($Filter)) {
            if ( isset($Filter['roles']) ) {
                if (!empty($Filter['roles'])) {
                    if (is_array($Filter['roles'])) {
                        $query->whereHas('Roles', function($Roles)use($Filter){
                            $Roles->whereIn('id', $Filter['roles']);
                        });
                    }
                    else {
                        $query->whereHas('Roles', function($Roles)use($Filter){
                            $Roles->where('id', $Filter['roles']);
                        });
                    }
                }
            }
            if ( isset($Filter['status']) ) {
                if (!empty($Filter['status'])) {
                    if (is_array($Filter['status'])) {
                        $query->whereIn($Preffix . 'status', $Filter['status']);
                    }
                    else {
                        $query->where($Preffix . 'status', $Filter['status']);
                    }
                }
            }
            if ( isset($Filter['user_locale']) ) {
                if (!empty($Filter['user_locale'])) {
                    if (is_array($Filter['user_locale'])) {
                        $query->whereIn($Preffix . 'locale', $Filter['user_locale']);
                    }
                    else {
                        $query->where($Preffix . 'locale', $Filter['user_locale']);
                    }
                }
            }
            if ( isset($Filter['gender']) ) {
                if (!empty($Filter['gender'])) {
                    if (is_array($Filter['gender'])) {
                        $query->whereIn($Preffix . 'gender', $Filter['gender']);
                    }
                    else {
                        $query->where($Preffix . 'gender', $Filter['gender']);
                    }
                }
            }
            if ( isset($Filter['country']) ) {
                if (!empty($Filter['country'])) {
                    if (is_array($Filter['country'])) {
                        $query->whereIn($Preffix . 'country_id', $Filter['country']);
                    }
                    else {
                        $query->where($Preffix . 'country_id', $Filter['country']);
                    }
                }
            }
            if ( isset($Filter['city']) ) {
                if (!empty($Filter['city'])) {
                    if (is_array($Filter['city'])) {
                        $query->whereIn($Preffix . 'city_id', $Filter['city']);
                    }
                    else {
                        $query->where($Preffix . 'city_id', $Filter['city']);
                    }
                }
            }
            if ( isset($Filter['username']) ) {
                if (!empty($Filter['username'])) {
                    $query->where($Preffix . 'username', 'like', "%{$Filter['username']}%");
                }
            }
            if ( isset($Filter['email']) ) {
                if (!empty($Filter['email'])) {
                    $query->where($Preffix . 'email', 'like', "%{$Filter['email']}%");
                }
            }
            if ( isset($Filter['phone_number']) ) {
                if (!empty($Filter['phone_number'])) {
                    $query->where($Preffix . 'phone_number', 'like', "%{$Filter['phone_number']}%");
                }
            }
            if ( isset($Filter['first_name']) ) {
                if (!empty($Filter['first_name'])) {
                    $query->where($Preffix . 'first_name', 'like', "%{$Filter['first_name']}%");
                }
            }
            if ( isset($Filter['last_name']) ) {
                if (!empty($Filter['last_name'])) {
                    $query->where($Preffix . 'last_name', 'like', "%{$Filter['last_name']}%");
                }
            }
        }
        return $query;
    }

    public function scopeNotRoot($query)
    {
        return $query->whereHas('roles', function($q) {
            $q->where('name', '!=', 'ROOT');
        });
    }

    public function scopeVerified($query)
    {
        return $query->whereNull('login_code');
    }

    public function scopeApproved($query)
    {
        return $query->where('needs_approval', 'N');
    }

    public function isRegistered()
    {
        return $this->is_new_account == 'N';
    }

    protected static function boot()
    {
        parent::boot();

        static::startRegisteredScope();
        static::startVerifiedScope();

        // static::addGlobalScope('not_deprecated', function (Builder $builder) {
        //     $builder->whereRaw('`email` NOT LIKE "%DEPRECATED%"');
        // });

        // Exclude the ROOT users from all querys.
        // static::addGlobalScope('notRoot', function (Builder $builder) {
        //     $builder->where('type', '!=', 'ROOT');
        // });
    }

    public static function disableRegisteredScope()
    {
        static::$withRegisteredScope = false;
        return static::withoutGlobalScope('registered');
    }

    public static function enableRegisteredScope()
    {
        static::$withRegisteredScope = true;
        static::startRegisteredScope();
    }

    public static function startRegisteredScope()
    {
        if (! static::$withRegisteredScope) {
            return false;
        }
        static::addGlobalScope('registered', function (Builder $builder) {
            $builder->where('is_new_account', 'N');
        });
        return true;
    }

    public static function disableVerifiedScope()
    {
        static::$withVerifiedScope = false;
        return static::withoutGlobalScope('verified');
    }

    public static function enableVerifiedScope()
    {
        static::$withVerifiedScope = true;
        static::startVerifiedScope();
    }

    public static function startVerifiedScope()
    {
        if (! static::$withVerifiedScope) {
            return false;
        }
        static::addGlobalScope('verified', function (Builder $builder) {
            $builder->where('is_verified', 'Y');
        });
        return true;
    }

}