<?php

namespace Projektgopher\Scrawl;

use Projektgopher\Scrawl\Commands\MakeCommand;
use Projektgopher\Scrawl\Commands\PublishCommand;
use Projektgopher\Scrawl\Commands\UnpublishCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BlogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('scrawl')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasCommands(
                [
                MakeCommand::class,
                PublishCommand::class,
                UnpublishCommand::class,
                ]
            );
    }
}
