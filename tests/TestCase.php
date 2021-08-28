<?php

namespace Projektgopher\Blog\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Projektgopher\Blog\BlogServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BlogServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
