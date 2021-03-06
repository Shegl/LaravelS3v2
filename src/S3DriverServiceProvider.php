<?php namespace Kevindierkx\LaravelS3v2;

use Aws\S3\S3Client;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\AwsS3v2\AwsS3Adapter as S3Adapter;
use League\Flysystem\Filesystem as Flysystem;
use Storage;

class S3DriverServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('s3-v2', function ($app, $config) {
            $s3Config = array_only($config, ['key', 'region', 'secret', 'signature', 'base_url']);

            return new Flysystem(new S3Adapter(S3Client::factory($s3Config), $config['bucket']));
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
