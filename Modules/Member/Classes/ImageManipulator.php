<?php

namespace Modules\Member\Classes;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Server;

/**
 * ImageManipulator to handle images.
 */
class ImageManipulator
{
    public $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function deleteImage($path)
    {
        // Delete the cached images before deleting the original one.
        $this->server->deleteCache($path);

        return Storage::disk('public')->delete($path);
    }
}
