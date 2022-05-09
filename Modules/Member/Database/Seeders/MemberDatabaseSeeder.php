<?php

namespace Modules\Member\Database\Seeders;

use App\User;
use Bouncer;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\AbilityGroup;
use Modules\Member\Entities\City;
use Modules\Member\Entities\CityTranslation;
use Modules\Member\Entities\Country;
use Modules\Member\Entities\CountryTranslation;
use Modules\Member\Entities\Role;

class MemberDatabaseSeeder extends Seeder
{
    public $data = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call("OthersTableSeeder");
        DB::transaction(function () {
            $this->SeedUsersPermissions();
            $this->SeedRolesPermissions();
            $this->SeedConfigPermissions();
            $this->SeedCountriesPermissions();
            $this->SeedSystemRoles();
            $this->SeedRootUser();
            $this->seedCountriesAndCities();
        });

    }

    protected function SeedCitiesPermissions()
    {
        $this->data['CITIES_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'CITIES']);
        $this->data['CITIES_ABILITY_GROUP']->code               = 'CITIES';
        $this->data['CITIES_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['CITIES_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['CITIES_ABILITY_GROUP']->{'title:en'}       = 'Cities Management';
        $this->data['CITIES_ABILITY_GROUP']->{'description:en'} = 'Cities Management Description';
        $this->data['CITIES_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  المدن';
        $this->data['CITIES_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['CITIES_ABILITY_GROUP']->save();

        $this->data['READ_CITIES']                     = Ability::firstOrNew(['name' => 'READ_CITIES']);
        $this->data['READ_CITIES']->name               = 'READ_CITIES';
        $this->data['READ_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['READ_CITIES']->base_locale        = 'en';
        $this->data['READ_CITIES']->{'title:en'}       = 'Read';
        $this->data['READ_CITIES']->{'description:en'} = null;
        $this->data['READ_CITIES']->{'title:ar'}       = 'قراءة';
        $this->data['READ_CITIES']->{'description:ar'} = null;
        $this->data['READ_CITIES']->save();

        $this->data['CREATE_CITIES']                     = Ability::firstOrNew(['name' => 'CREATE_CITIES']);
        $this->data['CREATE_CITIES']->name               = 'CREATE_CITIES';
        $this->data['CREATE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['CREATE_CITIES']->base_locale        = 'en';
        $this->data['CREATE_CITIES']->{'title:en'}       = 'Create';
        $this->data['CREATE_CITIES']->{'description:en'} = null;
        $this->data['CREATE_CITIES']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_CITIES']->{'description:ar'} = null;
        $this->data['CREATE_CITIES']->save();

        $this->data['UPDATE_CITIES']                     = Ability::firstOrNew(['name' => 'UPDATE_CITIES']);
        $this->data['UPDATE_CITIES']->name               = 'UPDATE_CITIES';
        $this->data['UPDATE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['UPDATE_CITIES']->base_locale        = 'en';
        $this->data['UPDATE_CITIES']->{'title:en'}       = 'Update';
        $this->data['UPDATE_CITIES']->{'description:en'} = null;
        $this->data['UPDATE_CITIES']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_CITIES']->{'description:ar'} = null;
        $this->data['UPDATE_CITIES']->save();

        $this->data['DELETE_CITIES']                     = Ability::firstOrNew(['name' => 'DELETE_CITIES']);
        $this->data['DELETE_CITIES']->name               = 'DELETE_CITIES';
        $this->data['DELETE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['DELETE_CITIES']->base_locale        = 'en';
        $this->data['DELETE_CITIES']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_CITIES']->{'description:en'} = null;
        $this->data['DELETE_CITIES']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_CITIES']->{'description:ar'} = null;
        $this->data['DELETE_CITIES']->save();

        $this->data['RESTORE_CITIES']                     = Ability::firstOrNew(['name' => 'RESTORE_CITIES']);
        $this->data['RESTORE_CITIES']->name               = 'RESTORE_CITIES';
        $this->data['RESTORE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['RESTORE_CITIES']->base_locale        = 'en';
        $this->data['RESTORE_CITIES']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_CITIES']->{'description:en'} = null;
        $this->data['RESTORE_CITIES']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_CITIES']->{'description:ar'} = null;
        $this->data['RESTORE_CITIES']->save();

        $this->data['PERMA_DELETE_CITIES']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_CITIES']);
        $this->data['PERMA_DELETE_CITIES']->name               = 'PERMA_DELETE_CITIES';
        $this->data['PERMA_DELETE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_CITIES']->base_locale        = 'en';
        $this->data['PERMA_DELETE_CITIES']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_CITIES']->{'description:en'} = null;
        $this->data['PERMA_DELETE_CITIES']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_CITIES']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_CITIES']->save();

        $this->data['STATUS_UPDATE_CITIES']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_CITIES']);
        $this->data['STATUS_UPDATE_CITIES']->name               = 'STATUS_UPDATE_CITIES';
        $this->data['STATUS_UPDATE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_CITIES']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_CITIES']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_CITIES']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_CITIES']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_CITIES']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_CITIES']->save();

        $this->data['PERMISSIONS_UPDATE_CITIES']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_CITIES']);
        $this->data['PERMISSIONS_UPDATE_CITIES']->name               = 'PERMISSIONS_UPDATE_CITIES';
        $this->data['PERMISSIONS_UPDATE_CITIES']->group_id           = $this->data['CITIES_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_CITIES']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_CITIES']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_CITIES']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_CITIES']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_CITIES']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_CITIES']->save();
    }

    protected function SeedCountriesPermissions()
    {
        $this->data['COUNTRIES_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'COUNTRIES']);
        $this->data['COUNTRIES_ABILITY_GROUP']->code               = 'COUNTRIES';
        $this->data['COUNTRIES_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['COUNTRIES_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['COUNTRIES_ABILITY_GROUP']->{'title:en'}       = 'Countries Management';
        $this->data['COUNTRIES_ABILITY_GROUP']->{'description:en'} = 'Countries Management Description';
        $this->data['COUNTRIES_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  الدول';
        $this->data['COUNTRIES_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['COUNTRIES_ABILITY_GROUP']->save();

        $this->data['READ_COUNTRIES']                     = Ability::firstOrNew(['name' => 'READ_COUNTRIES']);
        $this->data['READ_COUNTRIES']->name               = 'READ_COUNTRIES';
        $this->data['READ_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['READ_COUNTRIES']->base_locale        = 'en';
        $this->data['READ_COUNTRIES']->{'title:en'}       = 'Read';
        $this->data['READ_COUNTRIES']->{'description:en'} = null;
        $this->data['READ_COUNTRIES']->{'title:ar'}       = 'قراءة';
        $this->data['READ_COUNTRIES']->{'description:ar'} = null;
        $this->data['READ_COUNTRIES']->save();

        $this->data['CREATE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'CREATE_COUNTRIES']);
        $this->data['CREATE_COUNTRIES']->name               = 'CREATE_COUNTRIES';
        $this->data['CREATE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['CREATE_COUNTRIES']->base_locale        = 'en';
        $this->data['CREATE_COUNTRIES']->{'title:en'}       = 'Create';
        $this->data['CREATE_COUNTRIES']->{'description:en'} = null;
        $this->data['CREATE_COUNTRIES']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_COUNTRIES']->{'description:ar'} = null;
        $this->data['CREATE_COUNTRIES']->save();

        $this->data['UPDATE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'UPDATE_COUNTRIES']);
        $this->data['UPDATE_COUNTRIES']->name               = 'UPDATE_COUNTRIES';
        $this->data['UPDATE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['UPDATE_COUNTRIES']->base_locale        = 'en';
        $this->data['UPDATE_COUNTRIES']->{'title:en'}       = 'Update';
        $this->data['UPDATE_COUNTRIES']->{'description:en'} = null;
        $this->data['UPDATE_COUNTRIES']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_COUNTRIES']->{'description:ar'} = null;
        $this->data['UPDATE_COUNTRIES']->save();

        $this->data['DELETE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'DELETE_COUNTRIES']);
        $this->data['DELETE_COUNTRIES']->name               = 'DELETE_COUNTRIES';
        $this->data['DELETE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['DELETE_COUNTRIES']->base_locale        = 'en';
        $this->data['DELETE_COUNTRIES']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_COUNTRIES']->{'description:en'} = null;
        $this->data['DELETE_COUNTRIES']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_COUNTRIES']->{'description:ar'} = null;
        $this->data['DELETE_COUNTRIES']->save();

        $this->data['RESTORE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'RESTORE_COUNTRIES']);
        $this->data['RESTORE_COUNTRIES']->name               = 'RESTORE_COUNTRIES';
        $this->data['RESTORE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['RESTORE_COUNTRIES']->base_locale        = 'en';
        $this->data['RESTORE_COUNTRIES']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_COUNTRIES']->{'description:en'} = null;
        $this->data['RESTORE_COUNTRIES']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_COUNTRIES']->{'description:ar'} = null;
        $this->data['RESTORE_COUNTRIES']->save();

        $this->data['PERMA_DELETE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_COUNTRIES']);
        $this->data['PERMA_DELETE_COUNTRIES']->name               = 'PERMA_DELETE_COUNTRIES';
        $this->data['PERMA_DELETE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_COUNTRIES']->base_locale        = 'en';
        $this->data['PERMA_DELETE_COUNTRIES']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_COUNTRIES']->{'description:en'} = null;
        $this->data['PERMA_DELETE_COUNTRIES']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_COUNTRIES']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_COUNTRIES']->save();

        $this->data['STATUS_UPDATE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_COUNTRIES']);
        $this->data['STATUS_UPDATE_COUNTRIES']->name               = 'STATUS_UPDATE_COUNTRIES';
        $this->data['STATUS_UPDATE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_COUNTRIES']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_COUNTRIES']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_COUNTRIES']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_COUNTRIES']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_COUNTRIES']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_COUNTRIES']->save();

        $this->data['PERMISSIONS_UPDATE_COUNTRIES']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_COUNTRIES']);
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->name               = 'PERMISSIONS_UPDATE_COUNTRIES';
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->group_id           = $this->data['COUNTRIES_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_COUNTRIES']->save();

    }

    protected function SeedUsersPermissions()
    {
        $this->data['USERS_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'USERS']);
        $this->data['USERS_ABILITY_GROUP']->code               = 'USERS';
        $this->data['USERS_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['USERS_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['USERS_ABILITY_GROUP']->{'title:en'}       = 'Users Management';
        $this->data['USERS_ABILITY_GROUP']->{'description:en'} = 'Users Management Description';
        $this->data['USERS_ABILITY_GROUP']->{'title:ar'}       = 'ادارة المستخدمين';
        $this->data['USERS_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['USERS_ABILITY_GROUP']->save();

        $this->data['READ_USERS']                     = Ability::firstOrNew(['name' => 'READ_USERS']);
        $this->data['READ_USERS']->name               = 'READ_USERS';
        $this->data['READ_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['READ_USERS']->base_locale        = 'en';
        $this->data['READ_USERS']->{'title:en'}       = 'Read';
        $this->data['READ_USERS']->{'description:en'} = null;
        $this->data['READ_USERS']->{'title:ar'}       = 'قراءة';
        $this->data['READ_USERS']->{'description:ar'} = null;
        $this->data['READ_USERS']->save();

        $this->data['CREATE_USERS']                     = Ability::firstOrNew(['name' => 'CREATE_USERS']);
        $this->data['CREATE_USERS']->name               = 'CREATE_USERS';
        $this->data['CREATE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['CREATE_USERS']->base_locale        = 'en';
        $this->data['CREATE_USERS']->{'title:en'}       = 'Create';
        $this->data['CREATE_USERS']->{'description:en'} = null;
        $this->data['CREATE_USERS']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_USERS']->{'description:ar'} = null;
        $this->data['CREATE_USERS']->save();

        $this->data['UPDATE_USERS']                     = Ability::firstOrNew(['name' => 'UPDATE_USERS']);
        $this->data['UPDATE_USERS']->name               = 'UPDATE_USERS';
        $this->data['UPDATE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['UPDATE_USERS']->base_locale        = 'en';
        $this->data['UPDATE_USERS']->{'title:en'}       = 'Update';
        $this->data['UPDATE_USERS']->{'description:en'} = null;
        $this->data['UPDATE_USERS']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_USERS']->{'description:ar'} = null;
        $this->data['UPDATE_USERS']->save();

        $this->data['DELETE_USERS']                     = Ability::firstOrNew(['name' => 'DELETE_USERS']);
        $this->data['DELETE_USERS']->name               = 'DELETE_USERS';
        $this->data['DELETE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['DELETE_USERS']->base_locale        = 'en';
        $this->data['DELETE_USERS']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_USERS']->{'description:en'} = null;
        $this->data['DELETE_USERS']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_USERS']->{'description:ar'} = null;
        $this->data['DELETE_USERS']->save();

        $this->data['RESTORE_USERS']                     = Ability::firstOrNew(['name' => 'RESTORE_USERS']);
        $this->data['RESTORE_USERS']->name               = 'RESTORE_USERS';
        $this->data['RESTORE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['RESTORE_USERS']->base_locale        = 'en';
        $this->data['RESTORE_USERS']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_USERS']->{'description:en'} = null;
        $this->data['RESTORE_USERS']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_USERS']->{'description:ar'} = null;
        $this->data['RESTORE_USERS']->save();

        $this->data['PERMA_DELETE_USERS']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_USERS']);
        $this->data['PERMA_DELETE_USERS']->name               = 'PERMA_DELETE_USERS';
        $this->data['PERMA_DELETE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_USERS']->base_locale        = 'en';
        $this->data['PERMA_DELETE_USERS']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_USERS']->{'description:en'} = null;
        $this->data['PERMA_DELETE_USERS']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_USERS']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_USERS']->save();

        $this->data['STATUS_UPDATE_USERS']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_USERS']);
        $this->data['STATUS_UPDATE_USERS']->name               = 'STATUS_UPDATE_USERS';
        $this->data['STATUS_UPDATE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_USERS']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_USERS']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_USERS']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_USERS']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_USERS']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_USERS']->save();

        $this->data['PERMISSIONS_UPDATE_USERS']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_USERS']);
        $this->data['PERMISSIONS_UPDATE_USERS']->name               = 'PERMISSIONS_UPDATE_USERS';
        $this->data['PERMISSIONS_UPDATE_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_USERS']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_USERS']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_USERS']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_USERS']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_USERS']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_USERS']->save();

        $this->data['LOGIN_AS_USERS']                     = Ability::firstOrNew(['name' => 'LOGIN_AS_USERS']);
        $this->data['LOGIN_AS_USERS']->name               = 'LOGIN_AS_USERS';
        $this->data['LOGIN_AS_USERS']->group_id           = $this->data['USERS_ABILITY_GROUP']->id;
        $this->data['LOGIN_AS_USERS']->base_locale        = 'en';
        $this->data['LOGIN_AS_USERS']->{'title:en'}       = 'Login As Any User In The System';
        $this->data['LOGIN_AS_USERS']->{'description:en'} = null;
        $this->data['LOGIN_AS_USERS']->{'title:ar'}       = 'يستطيع تسجيل الدخول الى اي حساب في النظام';
        $this->data['LOGIN_AS_USERS']->{'description:ar'} = null;
        $this->data['LOGIN_AS_USERS']->save();
    }

    protected function SeedRolesPermissions()
    {
        $this->data['ROLES_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'ROLES']);
        $this->data['ROLES_ABILITY_GROUP']->code               = 'ROLES';
        $this->data['ROLES_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['ROLES_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['ROLES_ABILITY_GROUP']->{'title:en'}       = 'Roles Management';
        $this->data['ROLES_ABILITY_GROUP']->{'description:en'} = null;
        $this->data['ROLES_ABILITY_GROUP']->{'title:ar'}       = 'ادارة مجموعة الصلاحيات';
        $this->data['ROLES_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['ROLES_ABILITY_GROUP']->save();

        $this->data['READ_ROLES']                     = Ability::firstOrNew(['name' => 'READ_ROLES']);
        $this->data['READ_ROLES']->name               = 'READ_ROLES';
        $this->data['READ_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['READ_ROLES']->base_locale        = 'en';
        $this->data['READ_ROLES']->{'title:en'}       = 'Read';
        $this->data['READ_ROLES']->{'description:en'} = null;
        $this->data['READ_ROLES']->{'title:ar'}       = 'قراءة';
        $this->data['READ_ROLES']->{'description:ar'} = null;
        $this->data['READ_ROLES']->save();

        $this->data['CREATE_ROLES']                     = Ability::firstOrNew(['name' => 'CREATE_ROLES']);
        $this->data['CREATE_ROLES']->name               = 'CREATE_ROLES';
        $this->data['CREATE_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['CREATE_ROLES']->base_locale        = 'en';
        $this->data['CREATE_ROLES']->{'title:en'}       = 'Create';
        $this->data['CREATE_ROLES']->{'description:en'} = null;
        $this->data['CREATE_ROLES']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_ROLES']->{'description:ar'} = null;
        $this->data['CREATE_ROLES']->save();

        $this->data['UPDATE_ROLES']                     = Ability::firstOrNew(['name' => 'UPDATE_ROLES']);
        $this->data['UPDATE_ROLES']->name               = 'UPDATE_ROLES';
        $this->data['UPDATE_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['UPDATE_ROLES']->base_locale        = 'en';
        $this->data['UPDATE_ROLES']->{'title:en'}       = 'Update';
        $this->data['UPDATE_ROLES']->{'description:en'} = null;
        $this->data['UPDATE_ROLES']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_ROLES']->{'description:ar'} = null;
        $this->data['UPDATE_ROLES']->save();

        $this->data['DELETE_ROLES']                     = Ability::firstOrNew(['name' => 'DELETE_ROLES']);
        $this->data['DELETE_ROLES']->name               = 'DELETE_ROLES';
        $this->data['DELETE_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['DELETE_ROLES']->base_locale        = 'en';
        $this->data['DELETE_ROLES']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_ROLES']->{'description:en'} = null;
        $this->data['DELETE_ROLES']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_ROLES']->{'description:ar'} = null;
        $this->data['DELETE_ROLES']->save();

        $this->data['RESTORE_ROLES']                     = Ability::firstOrNew(['name' => 'RESTORE_ROLES']);
        $this->data['RESTORE_ROLES']->name               = 'RESTORE_ROLES';
        $this->data['RESTORE_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['RESTORE_ROLES']->base_locale        = 'en';
        $this->data['RESTORE_ROLES']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_ROLES']->{'description:en'} = null;
        $this->data['RESTORE_ROLES']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_ROLES']->{'description:ar'} = null;
        $this->data['RESTORE_ROLES']->save();

        $this->data['PERMA_DELETE_ROLES']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_ROLES']);
        $this->data['PERMA_DELETE_ROLES']->name               = 'PERMA_DELETE_ROLES';
        $this->data['PERMA_DELETE_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_ROLES']->base_locale        = 'en';
        $this->data['PERMA_DELETE_ROLES']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_ROLES']->{'description:en'} = null;
        $this->data['PERMA_DELETE_ROLES']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_ROLES']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_ROLES']->save();

        $this->data['STATUS_UPDATE_ROLES']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_ROLES']);
        $this->data['STATUS_UPDATE_ROLES']->name               = 'STATUS_UPDATE_ROLES';
        $this->data['STATUS_UPDATE_ROLES']->group_id           = $this->data['ROLES_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_ROLES']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_ROLES']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_ROLES']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_ROLES']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_ROLES']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_ROLES']->save();
    }

    protected function SeedConfigPermissions()
    {
        $this->data['CONFIG_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'CONFIG']);
        $this->data['CONFIG_ABILITY_GROUP']->code               = 'CONFIG';
        $this->data['CONFIG_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['CONFIG_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['CONFIG_ABILITY_GROUP']->{'title:en'}       = 'CONFIG Management';
        $this->data['CONFIG_ABILITY_GROUP']->{'description:en'} = null;
        $this->data['CONFIG_ABILITY_GROUP']->{'title:ar'}       = 'ادارة اعدادات النظام العامة';
        $this->data['CONFIG_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['CONFIG_ABILITY_GROUP']->save();

        $this->data['READ_CONFIG']                     = Ability::firstOrNew(['name' => 'READ_CONFIG']);
        $this->data['READ_CONFIG']->name               = 'READ_CONFIG';
        $this->data['READ_CONFIG']->group_id           = $this->data['CONFIG_ABILITY_GROUP']->id;
        $this->data['READ_CONFIG']->base_locale        = 'en';
        $this->data['READ_CONFIG']->{'title:en'}       = 'Read';
        $this->data['READ_CONFIG']->{'description:en'} = null;
        $this->data['READ_CONFIG']->{'title:ar'}       = 'قراءة';
        $this->data['READ_CONFIG']->{'description:ar'} = null;
        $this->data['READ_CONFIG']->save();

        $this->data['UPDATE_CONFIG']                     = Ability::firstOrNew(['name' => 'UPDATE_CONFIG']);
        $this->data['UPDATE_CONFIG']->name               = 'UPDATE_CONFIG';
        $this->data['UPDATE_CONFIG']->group_id           = $this->data['CONFIG_ABILITY_GROUP']->id;
        $this->data['UPDATE_CONFIG']->base_locale        = 'en';
        $this->data['UPDATE_CONFIG']->{'title:en'}       = 'Update';
        $this->data['UPDATE_CONFIG']->{'description:en'} = null;
        $this->data['UPDATE_CONFIG']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_CONFIG']->{'description:ar'} = null;
        $this->data['UPDATE_CONFIG']->save();
    }

    protected function SeedSystemRoles()
    {
        $this->data['USER_Role']       = Role::firstOrNew(['name' => 'USER']);
        $this->data['USER_Role']->name = 'USER';
        // $this->data['USER_Role']->level              = 100;
        $this->data['USER_Role']->deletable          = 0;
        $this->data['USER_Role']->updatable          = 0;
        $this->data['USER_Role']->base_locale        = 'en';
        $this->data['USER_Role']->{'title:en'}       = 'New Users';
        $this->data['USER_Role']->{'description:en'} = null;
        $this->data['USER_Role']->{'title:ar'}       = 'مستخدمين جدد';
        $this->data['USER_Role']->{'description:ar'} = null;
        $this->data['USER_Role']->save();

        $this->data['ROOT_Role']       = Role::firstOrNew(['name' => 'ROOT']);
        $this->data['ROOT_Role']->name = 'ROOT';
        // $this->data['ROOT_Role']->level              = 100;
        $this->data['ROOT_Role']->deletable          = 0;
        $this->data['ROOT_Role']->updatable          = 0;
        $this->data['ROOT_Role']->base_locale        = 'en';
        $this->data['ROOT_Role']->{'title:en'}       = 'Root Group';
        $this->data['ROOT_Role']->{'description:en'} = 'All Permissions Are Assigned To This Group By Default.';
        $this->data['ROOT_Role']->{'title:ar'}       = 'مطور';
        $this->data['ROOT_Role']->{'description:ar'} = 'جميع الصلاحيات مضافة افتراضيا الى هذه المجموعة.';
        $this->data['ROOT_Role']->save();

        $this->data['SYSTEM_ADMIN_Role']       = Role::firstOrNew(['name' => 'SYSTEM_ADMIN']);
        $this->data['SYSTEM_ADMIN_Role']->name = 'SYSTEM_ADMIN';
        // $this->data['SYSTEM_ADMIN_Role']->level              = 90;
        $this->data['SYSTEM_ADMIN_Role']->deletable          = 0;
        $this->data['SYSTEM_ADMIN_Role']->updatable          = 0;
        $this->data['SYSTEM_ADMIN_Role']->base_locale        = 'en';
        $this->data['SYSTEM_ADMIN_Role']->{'title:en'}       = 'System Admin';
        $this->data['SYSTEM_ADMIN_Role']->{'description:en'} = 'All Safe Permissions Are Assigned To This Group By Default.';
        $this->data['SYSTEM_ADMIN_Role']->{'title:ar'}       = 'مدير النظام';
        $this->data['SYSTEM_ADMIN_Role']->{'description:ar'} = 'جميع الصلاحيات الامنة مضافة افتراضيا الى هذه المجموعة.';
        $this->data['SYSTEM_ADMIN_Role']->save();

        $this->data['AGENT_Role']       = Role::firstOrNew(['name' => 'AGENT']);
        $this->data['AGENT_Role']->name = 'AGENT';
        // $this->data['AGENT_Role']->level              = 90;
        $this->data['AGENT_Role']->deletable          = 0;
        $this->data['AGENT_Role']->updatable          = 0;
        $this->data['AGENT_Role']->base_locale        = 'en';
        $this->data['AGENT_Role']->{'title:en'}       = 'Agent';
        $this->data['AGENT_Role']->{'description:en'} = '';
        $this->data['AGENT_Role']->{'title:ar'}       = 'وكيل';
        $this->data['AGENT_Role']->{'description:ar'} = '';
        $this->data['AGENT_Role']->save();

        $this->data['EDITOR_Role']       = Role::firstOrNew(['name' => 'EDITOR']);
        $this->data['EDITOR_Role']->name = 'EDITOR';
        // $this->data['EDITOR_Role']->level              = 90;
        $this->data['EDITOR_Role']->deletable          = 0;
        $this->data['EDITOR_Role']->updatable          = 0;
        $this->data['EDITOR_Role']->base_locale        = 'en';
        $this->data['EDITOR_Role']->{'title:en'}       = 'Editor';
        $this->data['EDITOR_Role']->{'description:en'} = '';
        $this->data['EDITOR_Role']->{'title:ar'}       = 'محرر';
        $this->data['EDITOR_Role']->{'description:ar'} = '';
        $this->data['EDITOR_Role']->save();

        Bouncer::allow('SYSTEM_ADMIN')->to([
            'READ_USERS',
            'UPDATE_USERS',
            'CREATE_USERS',
            'DELETE_USERS',
            'STATUS_UPDATE_USERS',
            'PERMA_DELETE_USERS',
            'PERMISSIONS_UPDATE_USERS',
            'LOGIN_AS_USERS',
            'RESTORE_USERS',

            'READ_ROLES',
            'CREATE_ROLES',
            'UPDATE_ROLES',
            'DELETE_ROLES',
            'RESTORE_ROLES',
            'PERMA_DELETE_ROLES',
            'STATUS_UPDATE_ROLES',
        ]);

        Bouncer::allow('ROOT')->to([
            'READ_USERS',
            'UPDATE_USERS',
            'CREATE_USERS',
            'DELETE_USERS',
            'STATUS_UPDATE_USERS',
            'PERMA_DELETE_USERS',
            'PERMISSIONS_UPDATE_USERS',
            'LOGIN_AS_USERS',
            'RESTORE_USERS',

            'READ_ROLES',
            'CREATE_ROLES',
            'UPDATE_ROLES',
            'DELETE_ROLES',
            'RESTORE_ROLES',
            'PERMA_DELETE_ROLES',
            'STATUS_UPDATE_ROLES',
        ]);

    }

    protected function SeedRootUser()
    {
        $this->data['ROOT_USER'] = User::firstOrNew([
            // 'username' => 'root',
            'email' => 'root@almaknon.com',
        ]);
        $this->data['ROOT_USER']->first_name        = 'Root';
        $this->data['ROOT_USER']->last_name         = 'Account';
        $this->data['ROOT_USER']->email             = 'root@almaknon.com';
        $this->data['ROOT_USER']->username          = 'root';
        $this->data['ROOT_USER']->password          = Hash::make('12345678');
        $this->data['ROOT_USER']->locale            = 'en';
        $this->data['ROOT_USER']->email_verified_at = Carbon::now()->toDateTimeString();
        $this->data['ROOT_USER']->type              = 'ROOT';
        $this->data['ROOT_USER']->save();
        Bouncer::assign('ROOT')->to($this->data['ROOT_USER']);

        $this->data['SYSTEM_ADMIN_USER'] = User::firstOrNew([
            // 'username' => 'root',
            'email' => 'super_admin@almaknon.com',
        ]);
        $this->data['SYSTEM_ADMIN_USER']->first_name        = 'super admin';
        $this->data['SYSTEM_ADMIN_USER']->last_name         = 'Account';
        $this->data['SYSTEM_ADMIN_USER']->email             = 'super_admin@almaknon.com';
        $this->data['SYSTEM_ADMIN_USER']->username          = 'super admin';
        $this->data['SYSTEM_ADMIN_USER']->password          = Hash::make('12345678');
        $this->data['SYSTEM_ADMIN_USER']->locale            = 'en';
        $this->data['SYSTEM_ADMIN_USER']->email_verified_at = Carbon::now()->toDateTimeString();
        $this->data['SYSTEM_ADMIN_USER']->type              = 'SYSTEM_ADMIN';
        $this->data['SYSTEM_ADMIN_USER']->save();
        Bouncer::assign('SYSTEM_ADMIN')->to($this->data['SYSTEM_ADMIN_USER']);
    }

    protected function seedCountriesAndCities()
    {
        $CountriesCounts = Country::count();
        $CitiesCounts    = City::count();
        if ($CountriesCounts > 0 or $CitiesCounts > 0) {
            return true;
        }
        $Countries             = require __DIR__ . '/../SeedsTemplates/Countries.php';
        $CountriesTranslations = require __DIR__ . '/../SeedsTemplates/CountriesTranslations.php';
        $Cities                = require __DIR__ . '/../SeedsTemplates/Cities.php';
        $CitiesTranslations    = require __DIR__ . '/../SeedsTemplates/CitiesTranslations.php';

        foreach (collect($Countries)->chunk(250) as $key => $_250) {
            Country::insert($_250->toArray());
        }
        foreach (collect($CountriesTranslations)->chunk(250) as $key => $_250) {
            CountryTranslation::insert($_250->toArray());
        }
        foreach (collect($Cities)->chunk(250) as $key => $_250) {
            City::insert($_250->toArray());
        }
        foreach (collect($CitiesTranslations)->chunk(250) as $key => $_250) {
            CityTranslation::insert($_250->toArray());
        }
    }
}
