<?php

namespace Modules\Maknon\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Maknon\Entities\Offer;
use Modules\Maknon\Entities\Marka;
use Modules\Maknon\Entities\Fuel;
use Modules\Maknon\Entities\Condition;
use Modules\Maknon\Entities\Category;
use Modules\Maknon\Entities\Car;
use DB;
use Hash;
use Bouncer;
use Exception;
use Carbon\Carbon;
use App\User;
use Modules\Member\Entities\AbilityGroup;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\Role;

class MaknonDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Model::unguard();

         DB::transaction(function(){
            $this->SeedMarka();
            $this->SeedCondition();
            $this->SeedOffer();
            $this->SeedFuel();
            
            $this->SeedMarkasPermissions();
            $this->SeedConditionsPermissions();         
            $this->SeedFuelsPermissions();
            $this->SeedOffersPermissions();
            $this->SeedCarsPermissions();
        });
    }


    protected function SeedMarka()
    {
        // $this->data['Marka']                        = new Marka;
        // $this->data['Marka']->status                = 'ACTIVE';
        // $this->data['Marka']->{'name:en'}           = 'Diploma Degree';
        // $this->data['Marka']->{'description:en'}    = null;
        // $this->data['Marka']->{'name:ar'}           = 'معهد';
        // $this->data['Marka']->{'description:ar'}    = null;
        // $this->data['Marka']->save();
    }

    protected function SeedCondition()
    {
        $this->data['Condition']                        = new Condition;
        $this->data['Condition']->status                = 'ACTIVE';
        $this->data['Condition']->{'name:en'}           = 'News';
        $this->data['Condition']->{'description:en'}    = null;
        $this->data['Condition']->{'name:ar'}           = 'جديدة';
        $this->data['Condition']->{'description:ar'}    = null;
        $this->data['Condition']->save();


        $this->data['Condition']                        = new Condition;
        $this->data['Condition']->status                = 'ACTIVE';
        $this->data['Condition']->{'name:en'}           = 'Used';
        $this->data['Condition']->{'description:en'}    = null;
        $this->data['Condition']->{'name:ar'}           = 'مستعملة';
        $this->data['Condition']->{'description:ar'}    = null;
        $this->data['Condition']->save();

        $this->data['Condition']                        = new Condition;
        $this->data['Condition']->status                = 'ACTIVE';
        $this->data['Condition']->{'name:en'}           = 'Used good condition';
        $this->data['Condition']->{'description:en'}    = null;
        $this->data['Condition']->{'name:ar'}           = 'مستعملة بحالة جيدة';
        $this->data['Condition']->{'description:ar'}    = null;
        $this->data['Condition']->save();

        $this->data['Condition']                        = new Condition;
        $this->data['Condition']->status                = 'ACTIVE';
        $this->data['Condition']->{'name:en'}           = 'Certified';
        $this->data['Condition']->{'description:en'}    = null;
        $this->data['Condition']->{'name:ar'}           = 'معتمدة';
        $this->data['Condition']->{'description:ar'}    = null;
        $this->data['Condition']->save();
    }

     protected function SeedOffer()
    {
        $this->data['Offer']                        = new Offer;
        $this->data['Offer']->status                = 'ACTIVE';
        $this->data['Offer']->{'name:en'}           = 'special offer';
        $this->data['Offer']->{'description:en'}    = null;
        $this->data['Offer']->{'name:ar'}           = 'فرصة ذهبية';
        $this->data['Offer']->{'description:ar'}    = null;
        $this->data['Offer']->save();

        $this->data['Offer']                        = new Offer;
        $this->data['Offer']->status                = 'ACTIVE';
        $this->data['Offer']->{'name:en'}           = 'Premium';
        $this->data['Offer']->{'description:en'}    = null;
        $this->data['Offer']->{'name:ar'}           = 'أقساط';
        $this->data['Offer']->{'description:ar'}    = null;
        $this->data['Offer']->save();

        $this->data['Offer']                        = new Offer;
        $this->data['Offer']->status                = 'ACTIVE';
        $this->data['Offer']->{'name:en'}           = 'Sold';
        $this->data['Offer']->{'description:en'}    = null;
        $this->data['Offer']->{'name:ar'}           = 'مباع';
        $this->data['Offer']->{'description:ar'}    = null;
        $this->data['Offer']->save();

        $this->data['Offer']                        = new Offer;
        $this->data['Offer']->status                = 'ACTIVE';
        $this->data['Offer']->{'name:en'}           = 'leasing available';
        $this->data['Offer']->{'description:en'}    = null;
        $this->data['Offer']->{'name:ar'}           = 'متاح للتأجير';
        $this->data['Offer']->{'description:ar'}    = null;
        $this->data['Offer']->save();
    }

     protected function SeedFuel()
    {
        $this->data['Fuel']                        = new Fuel;
        $this->data['Fuel']->status                = 'ACTIVE';
        $this->data['Fuel']->{'name:en'}           = 'Gasoline';
        $this->data['Fuel']->{'description:en'}    = null;
        $this->data['Fuel']->{'name:ar'}           = 'الغازولين';
        $this->data['Fuel']->{'description:ar'}    = null;
        $this->data['Fuel']->save();

        $this->data['Fuel']                        = new Fuel;
        $this->data['Fuel']->status                = 'ACTIVE';
        $this->data['Fuel']->{'name:en'}           = 'Diesel';
        $this->data['Fuel']->{'description:en'}    = null;
        $this->data['Fuel']->{'name:ar'}           = 'الديزل';
        $this->data['Fuel']->{'description:ar'}    = null;
        $this->data['Fuel']->save();

        $this->data['Fuel']                        = new Fuel;
        $this->data['Fuel']->status                = 'ACTIVE';
        $this->data['Fuel']->{'name:en'}           = 'Biodiesel';
        $this->data['Fuel']->{'description:en'}    = null;
        $this->data['Fuel']->{'name:ar'}           = 'مباع';
        $this->data['Fuel']->{'description:ar'}    = null;
        $this->data['Fuel']->save();

        $this->data['Fuel']                        = new Fuel;
        $this->data['Fuel']->status                = 'ACTIVE';
        $this->data['Fuel']->{'name:en'}           = 'Ethanol';
        $this->data['Fuel']->{'description:en'}    = null;
        $this->data['Fuel']->{'name:ar'}           = 'الإيثانول';
        $this->data['Fuel']->{'description:ar'}    = null;
        $this->data['Fuel']->save();

        $this->data['Fuel']                        = new Fuel;
        $this->data['Fuel']->status                = 'ACTIVE';
        $this->data['Fuel']->{'name:en'}           = 'Compressed Natural Gas';
        $this->data['Fuel']->{'description:en'}    = null;
        $this->data['Fuel']->{'name:ar'}           = 'غاز طبيعي مضغوط';
        $this->data['Fuel']->{'description:ar'}    = null;
        $this->data['Fuel']->save();

        $this->data['Fuel']                        = new Fuel;
        $this->data['Fuel']->status                = 'ACTIVE';
        $this->data['Fuel']->{'name:en'}           = 'Liquified Petroleum Gas';
        $this->data['Fuel']->{'description:en'}    = null;
        $this->data['Fuel']->{'name:ar'}           = 'الغاز النفطي';
        $this->data['Fuel']->{'description:ar'}    = null;
        $this->data['Fuel']->save();
    }

    protected function SeedFuelsPermissions()
    {
        $this->data['FUELS_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'FUELS']);
        $this->data['FUELS_ABILITY_GROUP']->code               = 'FUELS';
        $this->data['FUELS_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['FUELS_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['FUELS_ABILITY_GROUP']->{'title:en'}       = 'Fuels Management';
        $this->data['FUELS_ABILITY_GROUP']->{'description:en'} = 'Test Fuels Management Description';
        $this->data['FUELS_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  انواع الوقود';
        $this->data['FUELS_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['FUELS_ABILITY_GROUP']->save();

        $this->data['READ_FUELS']                     = Ability::firstOrNew(['name' => 'READ_FUELS']);
        $this->data['READ_FUELS']->name               = 'READ_FUELS';
        $this->data['READ_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['READ_FUELS']->base_locale        = 'en';
        $this->data['READ_FUELS']->{'title:en'}       = 'Read';
        $this->data['READ_FUELS']->{'description:en'} = null;
        $this->data['READ_FUELS']->{'title:ar'}       = 'قراءة';
        $this->data['READ_FUELS']->{'description:ar'} = null;
        $this->data['READ_FUELS']->save();

        $this->data['CREATE_FUELS']                     = Ability::firstOrNew(['name' => 'CREATE_FUELS']);
        $this->data['CREATE_FUELS']->name               = 'CREATE_FUELS';
        $this->data['CREATE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['CREATE_FUELS']->base_locale        = 'en';
        $this->data['CREATE_FUELS']->{'title:en'}       = 'Create';
        $this->data['CREATE_FUELS']->{'description:en'} = null;
        $this->data['CREATE_FUELS']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_FUELS']->{'description:ar'} = null;
        $this->data['CREATE_FUELS']->save();

        $this->data['UPDATE_FUELS']                     = Ability::firstOrNew(['name' => 'UPDATE_FUELS']);
        $this->data['UPDATE_FUELS']->name               = 'UPDATE_FUELS';
        $this->data['UPDATE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['UPDATE_FUELS']->base_locale        = 'en';
        $this->data['UPDATE_FUELS']->{'title:en'}       = 'Update';
        $this->data['UPDATE_FUELS']->{'description:en'} = null;
        $this->data['UPDATE_FUELS']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_FUELS']->{'description:ar'} = null;
        $this->data['UPDATE_FUELS']->save();

        $this->data['DELETE_FUELS']                     = Ability::firstOrNew(['name' => 'DELETE_FUELS']);
        $this->data['DELETE_FUELS']->name               = 'DELETE_FUELS';
        $this->data['DELETE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['DELETE_FUELS']->base_locale        = 'en';
        $this->data['DELETE_FUELS']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_FUELS']->{'description:en'} = null;
        $this->data['DELETE_FUELS']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_FUELS']->{'description:ar'} = null;
        $this->data['DELETE_FUELS']->save();

        $this->data['RESTORE_FUELS']                     = Ability::firstOrNew(['name' => 'RESTORE_FUELS']);
        $this->data['RESTORE_FUELS']->name               = 'RESTORE_FUELS';
        $this->data['RESTORE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['RESTORE_FUELS']->base_locale        = 'en';
        $this->data['RESTORE_FUELS']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_FUELS']->{'description:en'} = null;
        $this->data['RESTORE_FUELS']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_FUELS']->{'description:ar'} = null;
        $this->data['RESTORE_FUELS']->save();

        $this->data['PERMA_DELETE_FUELS']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_FUELS']);
        $this->data['PERMA_DELETE_FUELS']->name               = 'PERMA_DELETE_FUELS';
        $this->data['PERMA_DELETE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_FUELS']->base_locale        = 'en';
        $this->data['PERMA_DELETE_FUELS']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_FUELS']->{'description:en'} = null;
        $this->data['PERMA_DELETE_FUELS']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_FUELS']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_FUELS']->save();

        $this->data['STATUS_UPDATE_FUELS']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_FUELS']);
        $this->data['STATUS_UPDATE_FUELS']->name               = 'STATUS_UPDATE_FUELS';
        $this->data['STATUS_UPDATE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_FUELS']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_FUELS']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_FUELS']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_FUELS']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_FUELS']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_FUELS']->save();

        $this->data['PERMISSIONS_UPDATE_FUELS']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_FUELS']);
        $this->data['PERMISSIONS_UPDATE_FUELS']->name               = 'PERMISSIONS_UPDATE_FUELS';
        $this->data['PERMISSIONS_UPDATE_FUELS']->group_id           = $this->data['FUELS_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_FUELS']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_FUELS']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_FUELS']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_FUELS']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_FUELS']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_FUELS']->save();
    }
    
    protected function SeedOffersPermissions()
    {
        $this->data['OFFERS_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'OFFERS']);
        $this->data['OFFERS_ABILITY_GROUP']->code               = 'OFFERS';
        $this->data['OFFERS_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['OFFERS_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['OFFERS_ABILITY_GROUP']->{'title:en'}       = 'Offers Management';
        $this->data['OFFERS_ABILITY_GROUP']->{'description:en'} = 'Test Offers Management Description';
        $this->data['OFFERS_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  العروض';
        $this->data['OFFERS_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['OFFERS_ABILITY_GROUP']->save();

        $this->data['READ_OFFERS']                     = Ability::firstOrNew(['name' => 'READ_OFFERS']);
        $this->data['READ_OFFERS']->name               = 'READ_OFFERS';
        $this->data['READ_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['READ_OFFERS']->base_locale        = 'en';
        $this->data['READ_OFFERS']->{'title:en'}       = 'Read';
        $this->data['READ_OFFERS']->{'description:en'} = null;
        $this->data['READ_OFFERS']->{'title:ar'}       = 'قراءة';
        $this->data['READ_OFFERS']->{'description:ar'} = null;
        $this->data['READ_OFFERS']->save();

        $this->data['CREATE_OFFERS']                     = Ability::firstOrNew(['name' => 'CREATE_OFFERS']);
        $this->data['CREATE_OFFERS']->name               = 'CREATE_OFFERS';
        $this->data['CREATE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['CREATE_OFFERS']->base_locale        = 'en';
        $this->data['CREATE_OFFERS']->{'title:en'}       = 'Create';
        $this->data['CREATE_OFFERS']->{'description:en'} = null;
        $this->data['CREATE_OFFERS']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_OFFERS']->{'description:ar'} = null;
        $this->data['CREATE_OFFERS']->save();

        $this->data['UPDATE_OFFERS']                     = Ability::firstOrNew(['name' => 'UPDATE_OFFERS']);
        $this->data['UPDATE_OFFERS']->name               = 'UPDATE_OFFERS';
        $this->data['UPDATE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['UPDATE_OFFERS']->base_locale        = 'en';
        $this->data['UPDATE_OFFERS']->{'title:en'}       = 'Update';
        $this->data['UPDATE_OFFERS']->{'description:en'} = null;
        $this->data['UPDATE_OFFERS']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_OFFERS']->{'description:ar'} = null;
        $this->data['UPDATE_OFFERS']->save();

        $this->data['DELETE_OFFERS']                     = Ability::firstOrNew(['name' => 'DELETE_OFFERS']);
        $this->data['DELETE_OFFERS']->name               = 'DELETE_OFFERS';
        $this->data['DELETE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['DELETE_OFFERS']->base_locale        = 'en';
        $this->data['DELETE_OFFERS']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_OFFERS']->{'description:en'} = null;
        $this->data['DELETE_OFFERS']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_OFFERS']->{'description:ar'} = null;
        $this->data['DELETE_OFFERS']->save();

        $this->data['RESTORE_OFFERS']                     = Ability::firstOrNew(['name' => 'RESTORE_OFFERS']);
        $this->data['RESTORE_OFFERS']->name               = 'RESTORE_OFFERS';
        $this->data['RESTORE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['RESTORE_OFFERS']->base_locale        = 'en';
        $this->data['RESTORE_OFFERS']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_OFFERS']->{'description:en'} = null;
        $this->data['RESTORE_OFFERS']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_OFFERS']->{'description:ar'} = null;
        $this->data['RESTORE_OFFERS']->save();

        $this->data['PERMA_DELETE_OFFERS']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_OFFERS']);
        $this->data['PERMA_DELETE_OFFERS']->name               = 'PERMA_DELETE_OFFERS';
        $this->data['PERMA_DELETE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_OFFERS']->base_locale        = 'en';
        $this->data['PERMA_DELETE_OFFERS']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_OFFERS']->{'description:en'} = null;
        $this->data['PERMA_DELETE_OFFERS']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_OFFERS']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_OFFERS']->save();

        $this->data['STATUS_UPDATE_OFFERS']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_OFFERS']);
        $this->data['STATUS_UPDATE_OFFERS']->name               = 'STATUS_UPDATE_OFFERS';
        $this->data['STATUS_UPDATE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_OFFERS']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_OFFERS']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_OFFERS']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_OFFERS']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_OFFERS']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_OFFERS']->save();

        $this->data['PERMISSIONS_UPDATE_OFFERS']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_OFFERS']);
        $this->data['PERMISSIONS_UPDATE_OFFERS']->name               = 'PERMISSIONS_UPDATE_OFFERS';
        $this->data['PERMISSIONS_UPDATE_OFFERS']->group_id           = $this->data['OFFERS_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_OFFERS']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_OFFERS']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_OFFERS']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_OFFERS']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_OFFERS']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_OFFERS']->save();
    }

    protected function SeedConditionsPermissions()
    {
        $this->data['CONDITIONS_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'CONDITIONS']);
        $this->data['CONDITIONS_ABILITY_GROUP']->code               = 'CONDITIONS';
        $this->data['CONDITIONS_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['CONDITIONS_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['CONDITIONS_ABILITY_GROUP']->{'title:en'}       = 'Conditions Management';
        $this->data['CONDITIONS_ABILITY_GROUP']->{'description:en'} = 'Test Conditions Management Description';
        $this->data['CONDITIONS_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  انواع الوقود';
        $this->data['CONDITIONS_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['CONDITIONS_ABILITY_GROUP']->save();

        $this->data['READ_CONDITIONS']                     = Ability::firstOrNew(['name' => 'READ_CONDITIONS']);
        $this->data['READ_CONDITIONS']->name               = 'READ_CONDITIONS';
        $this->data['READ_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['READ_CONDITIONS']->base_locale        = 'en';
        $this->data['READ_CONDITIONS']->{'title:en'}       = 'Read';
        $this->data['READ_CONDITIONS']->{'description:en'} = null;
        $this->data['READ_CONDITIONS']->{'title:ar'}       = 'قراءة';
        $this->data['READ_CONDITIONS']->{'description:ar'} = null;
        $this->data['READ_CONDITIONS']->save();

        $this->data['CREATE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'CREATE_CONDITIONS']);
        $this->data['CREATE_CONDITIONS']->name               = 'CREATE_CONDITIONS';
        $this->data['CREATE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['CREATE_CONDITIONS']->base_locale        = 'en';
        $this->data['CREATE_CONDITIONS']->{'title:en'}       = 'Create';
        $this->data['CREATE_CONDITIONS']->{'description:en'} = null;
        $this->data['CREATE_CONDITIONS']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_CONDITIONS']->{'description:ar'} = null;
        $this->data['CREATE_CONDITIONS']->save();

        $this->data['UPDATE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'UPDATE_CONDITIONS']);
        $this->data['UPDATE_CONDITIONS']->name               = 'UPDATE_CONDITIONS';
        $this->data['UPDATE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['UPDATE_CONDITIONS']->base_locale        = 'en';
        $this->data['UPDATE_CONDITIONS']->{'title:en'}       = 'Update';
        $this->data['UPDATE_CONDITIONS']->{'description:en'} = null;
        $this->data['UPDATE_CONDITIONS']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_CONDITIONS']->{'description:ar'} = null;
        $this->data['UPDATE_CONDITIONS']->save();

        $this->data['DELETE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'DELETE_CONDITIONS']);
        $this->data['DELETE_CONDITIONS']->name               = 'DELETE_CONDITIONS';
        $this->data['DELETE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['DELETE_CONDITIONS']->base_locale        = 'en';
        $this->data['DELETE_CONDITIONS']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_CONDITIONS']->{'description:en'} = null;
        $this->data['DELETE_CONDITIONS']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_CONDITIONS']->{'description:ar'} = null;
        $this->data['DELETE_CONDITIONS']->save();

        $this->data['RESTORE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'RESTORE_CONDITIONS']);
        $this->data['RESTORE_CONDITIONS']->name               = 'RESTORE_CONDITIONS';
        $this->data['RESTORE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['RESTORE_CONDITIONS']->base_locale        = 'en';
        $this->data['RESTORE_CONDITIONS']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_CONDITIONS']->{'description:en'} = null;
        $this->data['RESTORE_CONDITIONS']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_CONDITIONS']->{'description:ar'} = null;
        $this->data['RESTORE_CONDITIONS']->save();

        $this->data['PERMA_DELETE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_CONDITIONS']);
        $this->data['PERMA_DELETE_CONDITIONS']->name               = 'PERMA_DELETE_CONDITIONS';
        $this->data['PERMA_DELETE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_CONDITIONS']->base_locale        = 'en';
        $this->data['PERMA_DELETE_CONDITIONS']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_CONDITIONS']->{'description:en'} = null;
        $this->data['PERMA_DELETE_CONDITIONS']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_CONDITIONS']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_CONDITIONS']->save();

        $this->data['STATUS_UPDATE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_CONDITIONS']);
        $this->data['STATUS_UPDATE_CONDITIONS']->name               = 'STATUS_UPDATE_CONDITIONS';
        $this->data['STATUS_UPDATE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_CONDITIONS']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_CONDITIONS']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_CONDITIONS']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_CONDITIONS']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_CONDITIONS']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_CONDITIONS']->save();

        $this->data['PERMISSIONS_UPDATE_CONDITIONS']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_CONDITIONS']);
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->name               = 'PERMISSIONS_UPDATE_CONDITIONS';
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->group_id           = $this->data['CONDITIONS_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_CONDITIONS']->save();
    }

    protected function SeedMarkasPermissions()
    {
        $this->data['MARKA_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'MARKA']);
        $this->data['MARKA_ABILITY_GROUP']->code               = 'MARKA';
        $this->data['MARKA_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['MARKA_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['MARKA_ABILITY_GROUP']->{'title:en'}       = 'Markas Management';
        $this->data['MARKA_ABILITY_GROUP']->{'description:en'} = 'Test Markas Management Description';
        $this->data['MARKA_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  ماركات السيارات ';
        $this->data['MARKA_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['MARKA_ABILITY_GROUP']->save();

        $this->data['READ_MARKA']                     = Ability::firstOrNew(['name' => 'READ_MARKA']);
        $this->data['READ_MARKA']->name               = 'READ_MARKA';
        $this->data['READ_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['READ_MARKA']->base_locale        = 'en';
        $this->data['READ_MARKA']->{'title:en'}       = 'Read';
        $this->data['READ_MARKA']->{'description:en'} = null;
        $this->data['READ_MARKA']->{'title:ar'}       = 'قراءة';
        $this->data['READ_MARKA']->{'description:ar'} = null;
        $this->data['READ_MARKA']->save();

        $this->data['CREATE_MARKA']                     = Ability::firstOrNew(['name' => 'CREATE_MARKA']);
        $this->data['CREATE_MARKA']->name               = 'CREATE_MARKA';
        $this->data['CREATE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['CREATE_MARKA']->base_locale        = 'en';
        $this->data['CREATE_MARKA']->{'title:en'}       = 'Create';
        $this->data['CREATE_MARKA']->{'description:en'} = null;
        $this->data['CREATE_MARKA']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_MARKA']->{'description:ar'} = null;
        $this->data['CREATE_MARKA']->save();

        $this->data['UPDATE_MARKA']                     = Ability::firstOrNew(['name' => 'UPDATE_MARKA']);
        $this->data['UPDATE_MARKA']->name               = 'UPDATE_MARKA';
        $this->data['UPDATE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['UPDATE_MARKA']->base_locale        = 'en';
        $this->data['UPDATE_MARKA']->{'title:en'}       = 'Update';
        $this->data['UPDATE_MARKA']->{'description:en'} = null;
        $this->data['UPDATE_MARKA']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_MARKA']->{'description:ar'} = null;
        $this->data['UPDATE_MARKA']->save();

        $this->data['DELETE_MARKA']                     = Ability::firstOrNew(['name' => 'DELETE_MARKA']);
        $this->data['DELETE_MARKA']->name               = 'DELETE_MARKA';
        $this->data['DELETE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['DELETE_MARKA']->base_locale        = 'en';
        $this->data['DELETE_MARKA']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_MARKA']->{'description:en'} = null;
        $this->data['DELETE_MARKA']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_MARKA']->{'description:ar'} = null;
        $this->data['DELETE_MARKA']->save();

        $this->data['RESTORE_MARKA']                     = Ability::firstOrNew(['name' => 'RESTORE_MARKA']);
        $this->data['RESTORE_MARKA']->name               = 'RESTORE_MARKA';
        $this->data['RESTORE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['RESTORE_MARKA']->base_locale        = 'en';
        $this->data['RESTORE_MARKA']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_MARKA']->{'description:en'} = null;
        $this->data['RESTORE_MARKA']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_MARKA']->{'description:ar'} = null;
        $this->data['RESTORE_MARKA']->save();

        $this->data['PERMA_DELETE_MARKA']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_MARKA']);
        $this->data['PERMA_DELETE_MARKA']->name               = 'PERMA_DELETE_MARKA';
        $this->data['PERMA_DELETE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_MARKA']->base_locale        = 'en';
        $this->data['PERMA_DELETE_MARKA']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_MARKA']->{'description:en'} = null;
        $this->data['PERMA_DELETE_MARKA']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_MARKA']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_MARKA']->save();

        $this->data['STATUS_UPDATE_MARKA']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_MARKA']);
        $this->data['STATUS_UPDATE_MARKA']->name               = 'STATUS_UPDATE_MARKA';
        $this->data['STATUS_UPDATE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_MARKA']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_MARKA']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_MARKA']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_MARKA']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_MARKA']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_MARKA']->save();

        $this->data['PERMISSIONS_UPDATE_MARKA']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_MARKA']);
        $this->data['PERMISSIONS_UPDATE_MARKA']->name               = 'PERMISSIONS_UPDATE_MARKA';
        $this->data['PERMISSIONS_UPDATE_MARKA']->group_id           = $this->data['MARKA_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_MARKA']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_MARKA']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_MARKA']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_MARKA']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_MARKA']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_MARKA']->save();
    }

    protected function SeedCarsPermissions()
    {
        $this->data['CAR_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'CAR']);
        $this->data['CAR_ABILITY_GROUP']->code               = 'CAR';
        $this->data['CAR_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['CAR_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['CAR_ABILITY_GROUP']->{'title:en'}       = 'Cars Management';
        $this->data['CAR_ABILITY_GROUP']->{'description:en'} = 'Test Cars Management Description';
        $this->data['CAR_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  السيارات';
        $this->data['CAR_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['CAR_ABILITY_GROUP']->save();

        $this->data['READ_CAR']                     = Ability::firstOrNew(['name' => 'READ_CAR']);
        $this->data['READ_CAR']->name               = 'READ_CAR';
        $this->data['READ_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['READ_CAR']->base_locale        = 'en';
        $this->data['READ_CAR']->{'title:en'}       = 'Read';
        $this->data['READ_CAR']->{'description:en'} = null;
        $this->data['READ_CAR']->{'title:ar'}       = 'قراءة';
        $this->data['READ_CAR']->{'description:ar'} = null;
        $this->data['READ_CAR']->save();

        $this->data['CREATE_CAR']                     = Ability::firstOrNew(['name' => 'CREATE_CAR']);
        $this->data['CREATE_CAR']->name               = 'CREATE_CAR';
        $this->data['CREATE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['CREATE_CAR']->base_locale        = 'en';
        $this->data['CREATE_CAR']->{'title:en'}       = 'Create';
        $this->data['CREATE_CAR']->{'description:en'} = null;
        $this->data['CREATE_CAR']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_CAR']->{'description:ar'} = null;
        $this->data['CREATE_CAR']->save();

        $this->data['UPDATE_CAR']                     = Ability::firstOrNew(['name' => 'UPDATE_CAR']);
        $this->data['UPDATE_CAR']->name               = 'UPDATE_CAR';
        $this->data['UPDATE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['UPDATE_CAR']->base_locale        = 'en';
        $this->data['UPDATE_CAR']->{'title:en'}       = 'Update';
        $this->data['UPDATE_CAR']->{'description:en'} = null;
        $this->data['UPDATE_CAR']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_CAR']->{'description:ar'} = null;
        $this->data['UPDATE_CAR']->save();

        $this->data['DELETE_CAR']                     = Ability::firstOrNew(['name' => 'DELETE_CAR']);
        $this->data['DELETE_CAR']->name               = 'DELETE_CAR';
        $this->data['DELETE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['DELETE_CAR']->base_locale        = 'en';
        $this->data['DELETE_CAR']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_CAR']->{'description:en'} = null;
        $this->data['DELETE_CAR']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_CAR']->{'description:ar'} = null;
        $this->data['DELETE_CAR']->save();

        $this->data['RESTORE_CAR']                     = Ability::firstOrNew(['name' => 'RESTORE_CAR']);
        $this->data['RESTORE_CAR']->name               = 'RESTORE_CAR';
        $this->data['RESTORE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['RESTORE_CAR']->base_locale        = 'en';
        $this->data['RESTORE_CAR']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_CAR']->{'description:en'} = null;
        $this->data['RESTORE_CAR']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_CAR']->{'description:ar'} = null;
        $this->data['RESTORE_CAR']->save();

        $this->data['PERMA_DELETE_CAR']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_CAR']);
        $this->data['PERMA_DELETE_CAR']->name               = 'PERMA_DELETE_CAR';
        $this->data['PERMA_DELETE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_CAR']->base_locale        = 'en';
        $this->data['PERMA_DELETE_CAR']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_CAR']->{'description:en'} = null;
        $this->data['PERMA_DELETE_CAR']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_CAR']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_CAR']->save();

        $this->data['STATUS_UPDATE_CAR']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_CAR']);
        $this->data['STATUS_UPDATE_CAR']->name               = 'STATUS_UPDATE_CAR';
        $this->data['STATUS_UPDATE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_CAR']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_CAR']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_CAR']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_CAR']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_CAR']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_CAR']->save();

        $this->data['PERMISSIONS_UPDATE_CAR']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_CAR']);
        $this->data['PERMISSIONS_UPDATE_CAR']->name               = 'PERMISSIONS_UPDATE_CAR';
        $this->data['PERMISSIONS_UPDATE_CAR']->group_id           = $this->data['CAR_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_CAR']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_CAR']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_CAR']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_CAR']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_CAR']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_CAR']->save();
    }
 
}
