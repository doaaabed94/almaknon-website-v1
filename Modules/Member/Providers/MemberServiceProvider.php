<?php

namespace Modules\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Exception;
use View;
use Bouncer;
use LaravelLocalization;
use Carbon\Carbon;
use Modules\Member\Classes\Cms;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\Role;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Member\Http\Traits\Helpers;


class MemberServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Member';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'member';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {   
        $this->app['router']->aliasMiddleware('NeedPermissions', \Modules\Member\Http\Middleware\NeedPermissions::class);
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerVars();
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    protected function registerVars()
    {
        // \Bouncer::useAbilityModel(Ability::class);
        // \Bouncer::useRoleModel(Role::class);
        View::share('_LOCALE_', LaravelLocalization::getCurrentLocale());
        View::share('_ALL_LOCALES_', LaravelLocalization::getSupportedLocales());
        View::share('_DIR_', LaravelLocalization::getCurrentLocaleDirection());

    }
}
