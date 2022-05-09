https://jwt-auth.readthedocs.io/en/develop/laravel-installation/<br>
composer require tymon/jwt-auth<br>
config/app.php<br>
'providers' => [

    ...

    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]<br>

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"<br>
php artisan jwt:secret<br>

-------------------------------------------------

composer require astrotomic/laravel-translatable<br>

-------------------------------------------------

silber/bouncer<br>
composer require silber/bouncer<br>
php artisan vendor:publish --tag="bouncer.migrations"<br>

-------------------------------------------------

composer require nwidart/laravel-modules<br>
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"<br>
{<br>
  "autoload": {<br>
    "psr-4": {<br>
      "App\\": "app/",<br>
      "Modules\\": "Modules/",<br>
      "Database\\Factories\\": "database/factories/",<br>
      "Database\\Seeders\\": "database/seeders/"<br>
  }<br>
<br>
}<br>
composer dump-autoload<br>

-------------------------------------------------

composer require mcamara/laravel-localization
<br>
php artisan vendor:publish --provider="Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider"

