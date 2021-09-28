<?php

namespace Projektgopher\Scrawl\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class RoutesTest extends TestCase
{
    /** @test */
    public function it_registers_a_blog_post_route()
    {
        $this->assertNotFalse(array_search('blog/{slug}', collect(Route::getRoutes())->map(function ($route) {
            return $route->uri();
        })->toArray()));
    }

    /** @test */
    public function it_returns_a_200_if_the_blog_exists()
    {
        $this->withoutExceptionHandling();
        File::shouldReceive('exists')
            ->once()
            ->with(base_path('resources/blogs/published/test.md'))
            ->andReturn(true);
        File::shouldReceive('get')
            ->once()
            ->with(base_path('resources/blogs/published/test.md'))
            ->andReturn('test');

        // This is all just to allow the view() helper to pass.
        // There HAS to be a better way.
        File::shouldReceive('exists')
            ->once()
            ->andReturn(true);
        File::shouldReceive('lastModified')
            ->once();
        File::shouldReceive('get')
            ->once();
        File::shouldReceive('put')
            ->once();
        File::shouldReceive('getRequire')
            ->once();
        File::shouldReceive('exists')
            ->once();
        File::shouldReceive('exists')
            ->once();

        $this->get('/blog/test')->assertOk();
    }

    /** @test */
    public function it_returns_a_404_if_the_blog_does_not_exist()
    {
        $this->withoutExceptionHandling();
        File::shouldReceive('exists')
            ->once()
            ->with(base_path('resources/blogs/published/does-not-exist.md'))
            ->andReturn(false);

        $this->get('/blog/does-not-exist')->assertStatus(404);
    }

    /** @test */
    public function it_converts_md_to_html()
    {
        $this->withoutExceptionHandling();
        File::shouldReceive('exists')
            ->once()
            ->with(base_path('resources/blogs/published/published-post.md'))
            ->andReturn(true);
        File::shouldReceive('get')
            ->once()
            ->with(base_path('resources/blogs/published/published-post.md'))
            ->andReturn('# Hello World!');

        $this->get('/blog/published-post')
            ->assertOk()
            ->assertSee(value: '<h1>Hello World!</h1>', escape: false);
    }

    // it has named routes
    // it lists published blogs
}
