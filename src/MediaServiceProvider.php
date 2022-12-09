<?php

namespace Kedeka\Media;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MediaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('kedeka-media')
            ->hasMigration('create_media_table')
            ->hasRoutes('admin', 'web')
            ->hasCommand(MediaCommand::class);
    }

    public function packageRegistered()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kedeka/media.php', 'kedeka.media');
    }
}
