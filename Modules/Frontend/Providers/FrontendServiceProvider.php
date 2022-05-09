<?php

namespace Modules\Frontend\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Maknon\Entities\Condition;
use Modules\Maknon\Entities\Fuel;
use Modules\Maknon\Entities\Marka;
use Modules\Maknon\Entities\Offer;
use Modules\Maknon\Entities\Car;
use Modules\Member\Entities\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class FrontendServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Frontend';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'frontend';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerData();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
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


    public function registerData()
    {
       //  $markas =  Cache::remember('markas_data' . app()->getLocale(), 1440, function () {
       //      return Marka::translatedIn(app()->getLocale())->with('translations')->get();
       //  });
       
       // $conditions =  Cache::remember('conditions_data' . app()->getLocale(), 1440, function () {
       //      return Condition::translatedIn(app()->getLocale())->with('translations')->get();
       //  });

       // $fuels =  Cache::remember('fuels_data' . app()->getLocale(), 1440, function () {
       //      return Fuel::translatedIn(app()->getLocale())->with('translations')->get();
       //  });

       // $offers =  Cache::remember('offers_data' . app()->getLocale(), 1440, function () {
       //      return Offer::translatedIn(app()->getLocale())->with('translations')->get();
       //  });

       // $currencies =  Cache::remember('currencies_data' . app()->getLocale(), 1440, function () {
       //      return Offer::translatedIn(app()->getLocale())->with('translations')->get();
       //  });

       // $countries =  Cache::remember('Countries_data' . app()->getLocale(), 1440, function () {
       //      return Country::translatedIn(app()->getLocale())->with('translations')->get();
       //  });

       //  $markas =   Marka::translatedIn(app()->getLocale())->with('translations')->get();
       // $conditions =   Condition::translatedIn(app()->getLocale())->with('translations')->get();
       // $fuels =   Fuel::translatedIn(app()->getLocale())->with('translations')->get();
       // $offers =   Offer::translatedIn(app()->getLocale())->with('translations')->get();
       // $countries =   Country::translatedIn(app()->getLocale())->with('translations')->get();
       // $last_cars =   Car::translatedIn(app()->getLocale())->with(['translations','Marka','Condition','Fuel','Offer'])->paginate(8);



        $markas =   [];
       $conditions =  [];;
       $fuels =    [];
       $offers =  [];
       $countries =  [];
       $last_cars =  [];

        View::share('markas', $markas);
        View::share('conditions', $conditions);
        View::share('fuels', $fuels);
        View::share('offers', $offers);
       // View::share('currencies', $currencies);
        View::share('countries', $countries);
        View::share('last_cars', $last_cars);

    }
}
