<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('League\Glide\Server', function($app){

            $filesystem = $app->make('Illuminate\Contracts\Filesystem\Filesystem');
            $factory = $app->make('League\Glide\Responses\LaravelResponseFactory');

            return \League\Glide\ServerFactory::create([
                'response' => $factory,
                'source' => app('filesystem')->disk('gcs')->getDriver(),
                'cache' => false,
                'cache_path_prefix' => '.cache',
                'watermarks' => $filesystem->getDriver(),
                //'source_path_prefix' => 'upload/files/shares',
                //'watermarks_path_prefix' => 'photos/watermarks',
                // 'base_url' => 'photos',
            ]);
        });
    }
}
