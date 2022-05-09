<?php

namespace Modules\CMS\Database\Seeders;

use Modules\CMS\Entities\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CMS\Entities\CategoryTranslation;
use DB;
use Hash;
use Bouncer;
use Exception;
use Carbon\Carbon;
use App\User;
use Modules\Member\Entities\AbilityGroup;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\Role;

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        DB::transaction(function () {
            $this->SeedCategory();
            $this->SeedContentPermissions();
            $this->SeedCategoryPermissions();
            $this->SeedSubCategoryPermissions();

        });
    }

    protected function SeedCategory()
    {
        $this->data['Category']                     = new Category;
        $this->data['Category']->code               = 'blog';
        $this->data['Category']->{'name:en'}        = 'Blog';
        $this->data['Category']->{'description:en'} = null;
        $this->data['Category']->{'name:ar'}        = 'المدونة';
        $this->data['Category']->{'description:ar'} = null;
        $this->data['Category']->save();

        $this->data['Category']                     = new Category;
        $this->data['Category']->code               = 'who-we-are';
        $this->data['Category']->{'name:ar'}        = 'من نحن';
        $this->data['Category']->{'description:en'} = null;
        $this->data['Category']->{'name:en'}        = 'who we are';
        $this->data['Category']->{'description:ar'} = null;
        $this->data['Category']->save();

        $this->data['Category']                     = new Category;
        $this->data['Category']->code               = 'Reviews';
        $this->data['Category']->{'name:ar'}        = 'آراء العملاء';
        $this->data['Category']->{'description:en'} = null;
        $this->data['Category']->{'name:en'}        = 'Reviews';
        $this->data['Category']->{'description:ar'} = null;
        $this->data['Category']->save();


        $this->data['Category']                     = new Category;
        $this->data['Category']->code               = 'privacy-policy';
        $this->data['Category']->{'name:ar'}        = 'السياسة و الخصوصية';
        $this->data['Category']->{'description:en'} = null;
        $this->data['Category']->{'name:en'}        = 'privacy policy';
        $this->data['Category']->{'description:ar'} = null;
        $this->data['Category']->save();
    }

    protected function SeedContentPermissions()
    {
        $this->data['CONENT_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'CONENT']);
        $this->data['CONENT_ABILITY_GROUP']->code               = 'CONENT';
        $this->data['CONENT_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['CONENT_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['CONENT_ABILITY_GROUP']->{'title:en'}       = 'Content Management';
        $this->data['CONENT_ABILITY_GROUP']->{'description:en'} = 'Content Management Description';
        $this->data['CONENT_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  المحتوى';
        $this->data['CONENT_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['CONENT_ABILITY_GROUP']->save();

        $this->data['READ_CONENT']                     = Ability::firstOrNew(['name' => 'READ_CONENT']);
        $this->data['READ_CONENT']->name               = 'READ_CONENT';
        $this->data['READ_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['READ_CONENT']->base_locale        = 'en';
        $this->data['READ_CONENT']->{'title:en'}       = 'Read';
        $this->data['READ_CONENT']->{'description:en'} = null;
        $this->data['READ_CONENT']->{'title:ar'}       = 'قراءة';
        $this->data['READ_CONENT']->{'description:ar'} = null;
        $this->data['READ_CONENT']->save();

        $this->data['CREATE_CONENT']                     = Ability::firstOrNew(['name' => 'CREATE_CONENT']);
        $this->data['CREATE_CONENT']->name               = 'CREATE_CONENT';
        $this->data['CREATE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['CREATE_CONENT']->base_locale        = 'en';
        $this->data['CREATE_CONENT']->{'title:en'}       = 'Create';
        $this->data['CREATE_CONENT']->{'description:en'} = null;
        $this->data['CREATE_CONENT']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_CONENT']->{'description:ar'} = null;
        $this->data['CREATE_CONENT']->save();

        $this->data['UPDATE_CONENT']                     = Ability::firstOrNew(['name' => 'UPDATE_CONENT']);
        $this->data['UPDATE_CONENT']->name               = 'UPDATE_CONENT';
        $this->data['UPDATE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['UPDATE_CONENT']->base_locale        = 'en';
        $this->data['UPDATE_CONENT']->{'title:en'}       = 'Update';
        $this->data['UPDATE_CONENT']->{'description:en'} = null;
        $this->data['UPDATE_CONENT']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_CONENT']->{'description:ar'} = null;
        $this->data['UPDATE_CONENT']->save();

        $this->data['DELETE_CONENT']                     = Ability::firstOrNew(['name' => 'DELETE_CONENT']);
        $this->data['DELETE_CONENT']->name               = 'DELETE_CONENT';
        $this->data['DELETE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['DELETE_CONENT']->base_locale        = 'en';
        $this->data['DELETE_CONENT']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_CONENT']->{'description:en'} = null;
        $this->data['DELETE_CONENT']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_CONENT']->{'description:ar'} = null;
        $this->data['DELETE_CONENT']->save();

        $this->data['RESTORE_CONENT']                     = Ability::firstOrNew(['name' => 'RESTORE_CONENT']);
        $this->data['RESTORE_CONENT']->name               = 'RESTORE_CONENT';
        $this->data['RESTORE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['RESTORE_CONENT']->base_locale        = 'en';
        $this->data['RESTORE_CONENT']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_CONENT']->{'description:en'} = null;
        $this->data['RESTORE_CONENT']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_CONENT']->{'description:ar'} = null;
        $this->data['RESTORE_CONENT']->save();

        $this->data['PERMA_DELETE_CONENT']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_CONENT']);
        $this->data['PERMA_DELETE_CONENT']->name               = 'PERMA_DELETE_CONENT';
        $this->data['PERMA_DELETE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_CONENT']->base_locale        = 'en';
        $this->data['PERMA_DELETE_CONENT']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_CONENT']->{'description:en'} = null;
        $this->data['PERMA_DELETE_CONENT']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_CONENT']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_CONENT']->save();

        $this->data['STATUS_UPDATE_CONENT']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_CONENT']);
        $this->data['STATUS_UPDATE_CONENT']->name               = 'STATUS_UPDATE_CONENT';
        $this->data['STATUS_UPDATE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_CONENT']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_CONENT']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_CONENT']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_CONENT']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_CONENT']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_CONENT']->save();

        $this->data['PERMISSIONS_UPDATE_CONENT']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_CONENT']);
        $this->data['PERMISSIONS_UPDATE_CONENT']->name               = 'PERMISSIONS_UPDATE_CONENT';
        $this->data['PERMISSIONS_UPDATE_CONENT']->group_id           = $this->data['CONENT_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_CONENT']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_CONENT']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_CONENT']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_CONENT']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_CONENT']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_CONENT']->save();
    }

    protected function SeedCategoryPermissions()
    {
        $this->data['CATEGORY_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'CATEGORY']);
        $this->data['CATEGORY_ABILITY_GROUP']->code               = 'CATEGORY';
        $this->data['CATEGORY_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['CATEGORY_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['CATEGORY_ABILITY_GROUP']->{'title:en'}       = 'Categories Management';
        $this->data['CATEGORY_ABILITY_GROUP']->{'description:en'} = 'Categories and Pages Management Description';
        $this->data['CATEGORY_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  أنواع المحتوى و الصفحات';
        $this->data['CATEGORY_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['CATEGORY_ABILITY_GROUP']->save();

        $this->data['READ_CATEGORY']                     = Ability::firstOrNew(['name' => 'READ_CATEGORY']);
        $this->data['READ_CATEGORY']->name               = 'READ_CATEGORY';
        $this->data['READ_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['READ_CATEGORY']->base_locale        = 'en';
        $this->data['READ_CATEGORY']->{'title:en'}       = 'Read';
        $this->data['READ_CATEGORY']->{'description:en'} = null;
        $this->data['READ_CATEGORY']->{'title:ar'}       = 'قراءة';
        $this->data['READ_CATEGORY']->{'description:ar'} = null;
        $this->data['READ_CATEGORY']->save();

        $this->data['CREATE_CATEGORY']                     = Ability::firstOrNew(['name' => 'CREATE_CATEGORY']);
        $this->data['CREATE_CATEGORY']->name               = 'CREATE_CATEGORY';
        $this->data['CREATE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['CREATE_CATEGORY']->base_locale        = 'en';
        $this->data['CREATE_CATEGORY']->{'title:en'}       = 'Create';
        $this->data['CREATE_CATEGORY']->{'description:en'} = null;
        $this->data['CREATE_CATEGORY']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_CATEGORY']->{'description:ar'} = null;
        $this->data['CREATE_CATEGORY']->save();

        $this->data['UPDATE_CATEGORY']                     = Ability::firstOrNew(['name' => 'UPDATE_CATEGORY']);
        $this->data['UPDATE_CATEGORY']->name               = 'UPDATE_CATEGORY';
        $this->data['UPDATE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['UPDATE_CATEGORY']->base_locale        = 'en';
        $this->data['UPDATE_CATEGORY']->{'title:en'}       = 'Update';
        $this->data['UPDATE_CATEGORY']->{'description:en'} = null;
        $this->data['UPDATE_CATEGORY']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_CATEGORY']->{'description:ar'} = null;
        $this->data['UPDATE_CATEGORY']->save();

        $this->data['DELETE_CATEGORY']                     = Ability::firstOrNew(['name' => 'DELETE_CATEGORY']);
        $this->data['DELETE_CATEGORY']->name               = 'DELETE_CATEGORY';
        $this->data['DELETE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['DELETE_CATEGORY']->base_locale        = 'en';
        $this->data['DELETE_CATEGORY']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_CATEGORY']->{'description:en'} = null;
        $this->data['DELETE_CATEGORY']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_CATEGORY']->{'description:ar'} = null;
        $this->data['DELETE_CATEGORY']->save();

        $this->data['RESTORE_CATEGORY']                     = Ability::firstOrNew(['name' => 'RESTORE_CATEGORY']);
        $this->data['RESTORE_CATEGORY']->name               = 'RESTORE_CATEGORY';
        $this->data['RESTORE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['RESTORE_CATEGORY']->base_locale        = 'en';
        $this->data['RESTORE_CATEGORY']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_CATEGORY']->{'description:en'} = null;
        $this->data['RESTORE_CATEGORY']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_CATEGORY']->{'description:ar'} = null;
        $this->data['RESTORE_CATEGORY']->save();

        $this->data['PERMA_DELETE_CATEGORY']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_CATEGORY']);
        $this->data['PERMA_DELETE_CATEGORY']->name               = 'PERMA_DELETE_CATEGORY';
        $this->data['PERMA_DELETE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_CATEGORY']->base_locale        = 'en';
        $this->data['PERMA_DELETE_CATEGORY']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_CATEGORY']->{'description:en'} = null;
        $this->data['PERMA_DELETE_CATEGORY']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_CATEGORY']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_CATEGORY']->save();

        $this->data['STATUS_UPDATE_CATEGORY']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_CATEGORY']);
        $this->data['STATUS_UPDATE_CATEGORY']->name               = 'STATUS_UPDATE_CATEGORY';
        $this->data['STATUS_UPDATE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_CATEGORY']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_CATEGORY']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_CATEGORY']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_CATEGORY']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_CATEGORY']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_CATEGORY']->save();

        $this->data['PERMISSIONS_UPDATE_CATEGORY']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_CATEGORY']);
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->name               = 'PERMISSIONS_UPDATE_CATEGORY';
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->group_id           = $this->data['CATEGORY_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_CATEGORY']->save();
    }

    protected function SeedSubCategoryPermissions()
    {
        $this->data['SUB_CATEGORY_ABILITY_GROUP']                     = AbilityGroup::firstOrNew(['code' => 'SUB_CATEGORY']);
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->code               = 'SUB_CATEGORY';
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->icon               = 'flaticon-user-settings';
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->base_locale        = 'en';
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->{'title:en'}       = 'sub Categories Management';
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->{'description:en'} = 'sub Categories and Pages Management Description';
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->{'title:ar'}       = 'ادارة  الأقسام الفرعية في المحتوى';
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->{'description:ar'} = null;
        $this->data['SUB_CATEGORY_ABILITY_GROUP']->save();

        $this->data['READ_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'READ_SUB_CATEGORY']);
        $this->data['READ_SUB_CATEGORY']->name               = 'READ_SUB_CATEGORY';
        $this->data['READ_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['READ_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['READ_SUB_CATEGORY']->{'title:en'}       = 'Read';
        $this->data['READ_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['READ_SUB_CATEGORY']->{'title:ar'}       = 'قراءة';
        $this->data['READ_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['READ_SUB_CATEGORY']->save();

        $this->data['CREATE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'CREATE_SUB_CATEGORY']);
        $this->data['CREATE_SUB_CATEGORY']->name               = 'CREATE_SUB_CATEGORY';
        $this->data['CREATE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['CREATE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['CREATE_SUB_CATEGORY']->{'title:en'}       = 'Create';
        $this->data['CREATE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['CREATE_SUB_CATEGORY']->{'title:ar'}       = 'اضافة';
        $this->data['CREATE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['CREATE_SUB_CATEGORY']->save();

        $this->data['UPDATE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'UPDATE_SUB_CATEGORY']);
        $this->data['UPDATE_SUB_CATEGORY']->name               = 'UPDATE_SUB_CATEGORY';
        $this->data['UPDATE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['UPDATE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['UPDATE_SUB_CATEGORY']->{'title:en'}       = 'Update';
        $this->data['UPDATE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['UPDATE_SUB_CATEGORY']->{'title:ar'}       = 'تعديل';
        $this->data['UPDATE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['UPDATE_SUB_CATEGORY']->save();

        $this->data['DELETE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'DELETE_SUB_CATEGORY']);
        $this->data['DELETE_SUB_CATEGORY']->name               = 'DELETE_SUB_CATEGORY';
        $this->data['DELETE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['DELETE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['DELETE_SUB_CATEGORY']->{'title:en'}       = 'Send To Trash';
        $this->data['DELETE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['DELETE_SUB_CATEGORY']->{'title:ar'}       = 'ارسل الى السلة';
        $this->data['DELETE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['DELETE_SUB_CATEGORY']->save();

        $this->data['RESTORE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'RESTORE_SUB_CATEGORY']);
        $this->data['RESTORE_SUB_CATEGORY']->name               = 'RESTORE_SUB_CATEGORY';
        $this->data['RESTORE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['RESTORE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['RESTORE_SUB_CATEGORY']->{'title:en'}       = 'Restore';
        $this->data['RESTORE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['RESTORE_SUB_CATEGORY']->{'title:ar'}       = 'استعادة';
        $this->data['RESTORE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['RESTORE_SUB_CATEGORY']->save();

        $this->data['PERMA_DELETE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'PERMA_DELETE_SUB_CATEGORY']);
        $this->data['PERMA_DELETE_SUB_CATEGORY']->name               = 'PERMA_DELETE_SUB_CATEGORY';
        $this->data['PERMA_DELETE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['PERMA_DELETE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['PERMA_DELETE_SUB_CATEGORY']->{'title:en'}       = 'Perma Delete';
        $this->data['PERMA_DELETE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['PERMA_DELETE_SUB_CATEGORY']->{'title:ar'}       = 'حذف نهائي';
        $this->data['PERMA_DELETE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['PERMA_DELETE_SUB_CATEGORY']->save();

        $this->data['STATUS_UPDATE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'STATUS_UPDATE_SUB_CATEGORY']);
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->name               = 'STATUS_UPDATE_SUB_CATEGORY';
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->{'title:en'}       = 'Status Update';
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->{'title:ar'}       = 'تحديث الحالات';
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['STATUS_UPDATE_SUB_CATEGORY']->save();

        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']                     = Ability::firstOrNew(['name' => 'PERMISSIONS_UPDATE_SUB_CATEGORY']);
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->name               = 'PERMISSIONS_UPDATE_SUB_CATEGORY';
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->group_id           = $this->data['SUB_CATEGORY_ABILITY_GROUP']->id;
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->base_locale        = 'en';
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->{'title:en'}       = 'Assign Permissions';
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->{'description:en'} = null;
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->{'title:ar'}       = 'تحديد الصلاحيات';
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->{'description:ar'} = null;
        $this->data['PERMISSIONS_UPDATE_SUB_CATEGORY']->save();
    }
}
