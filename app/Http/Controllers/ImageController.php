<?php
/**
 * Created by PhpStorm.
 * User: Daniel Bigenius <daniel@hackyard.se>
 * Date: 07/12/16
 * Time: 16:01
 */


namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageController extends Controller
{
    public function show(Filesystem $filesystem, $path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(),
            'source' => app('filesystem')->disk('public')->getDriver(),
            'cache' => storage_path('glide'),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}

