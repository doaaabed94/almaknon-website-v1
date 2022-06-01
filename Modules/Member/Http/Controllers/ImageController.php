<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Server;

class ImageController extends Controller
{
    /**
     * Cache an image and return it.
     * @var Server
     * @var Request
     * @return Response
     */
    public function show(Server $server, Request $request)
    {
        if($server->sourceFileExists($request->path))
        {
            if($request->size == 'original')
            {
                $server->setDefaults([]);

                $name = $server->makeImage($request->path, []);
                $file = Storage::get($name);
                $type = Storage::mimeType($name);
                $response = \Response::make($file, 200)->header("Content-Type", $type);

                return $response;
            }

            $size = preg_split('/x/', $request->size);

            $options = [];

            if($size[0] != 'auto') $options['w'] = $size[0];
            if($size[1] != 'auto') $options['h'] = $size[1];
            if($request->has('extension')) $options['fm'] = $request->extension;
            if($request->has('quality')) $options['q'] = $request->quality;
            if($request->has('mark'))
            {
                $options['mark']        = request('mark', 'test.png');
                $options['markh']       = request('markh', '80h');
                if($request->has('markw')) $options['markw'] = $request->markw;
                $options['markalpha']   = request('markalpha', '60');
                $options['markpos']     = request('markpos', 'center');
            }

            $name = $server->makeImage($request->path, $options);
            $file = Storage::get($name);
            $type = Storage::mimeType($name);
            $response = \Response::make($file, 200)->header("Content-Type", $type);

            return $response;
        }
        else
        {
            abort(404);
        }
    }
}
