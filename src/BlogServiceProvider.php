<?php

namespace Projektgopher\Blog;

use Projektgopher\Blog\Commands\MakeCommand;
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
            ->name('laravel-blog')
            ->hasConfigFile()
            ->hasViews()
            // ->hasRoute()
            ->hasCommand(MakeCommand::class);
    }
}
