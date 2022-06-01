<?php

namespace Modules\Mmeber\Entities\Classes;

use League\Glide\Server as MainServer;

class Server extends MainServer
{
    /**
     * Generate and output image.
     * @param  string                   $path   Image path.
     * @param  array                    $params Image manipulation params.
     * @throws InvalidArgumentException
     */
    public function outputImage($path, array $params)
    {
        $path = $this->makeImage($path, $params);

        header('Content-Type:'.$this->cache->getMimetype($path));
        header('Content-Length:'.$this->cache->getSize($path));
        header('Cache-Control:'.'max-age=31536000, public');
        header('Expires:'.date_create('+1 years')->format('D, d M Y H:i:s').' GMT');

        $stream = $this->cache->readStream($path);

        if (ftell($stream) !== 0) {
            rewind($stream);
        }

        fclose($stream);
    }
}
