<?php

namespace Modules\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Member\Classes\ImageManipulator;
use League\Glide\ServerFactory;
use League\Glide\Server;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Server::class, function($app) {

            $filesystem = $app->make(Filesystem::class);

            return ServerFactory::create([
                'source'                    => $filesystem->getDriver(),
                'source_path_prefix'        => '',
                'cache'                     => $filesystem->getDriver(),
                'cache_path_prefix'         => '.cache',
                'driver'                    => 'gd',
                'defaults'                  =>  [
                    'fit'   => 'crop',
                    'fm'    => 'jpg',
                    'q'     => 75
                ]
                // 'group_cache_in_folders' =>  // Whether to group cached images in folders
                // 'watermarks' =>              // Watermarks filesystem
                // 'watermarks_path_prefix' =>  // Watermarks filesystem path prefix
                // 'max_image_size' =>          // Image size limit
                // 'presets' =>                 // Preset image manipulations
                // 'base_url' =>                // Base URL of the images
                // 'response' =>                // Response factory
            ]);

        });

        $this->app->singleton('ImageManipulator', function($app) {
            $server = $this->app->make(Server::class);
            return new ImageManipulator($server);
        });
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
}
