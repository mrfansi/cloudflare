<?php

namespace Mrfansi\Cloudflare;

use Mrfansi\Cloudflare\Commands\CloudflareCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CloudflareServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('cloudflare')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_cloudflare_table')
            ->hasCommand(CloudflareCommand::class);
    }
}
