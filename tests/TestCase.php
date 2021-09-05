<?php

namespace Projektgopher\Scrawl\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Projektgopher\Scrawl\BlogServiceProvider;

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
