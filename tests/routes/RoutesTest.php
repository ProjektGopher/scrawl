<?php

namespace Projektgopher\Blog\Tests;

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
        File::shouldReceive('exists')
            ->once()
            ->with('resources/blogs/published/test.md')
            ->andReturn(true);
        File::shouldReceive('get')
            ->once()
            ->with('resources/blogs/published/test.md')
            ->andReturn('test');

        $this->get('/blog/test')->assertOk();
    }

    /** @test */
    public function it_returns_a_404_if_the_blog_does_not_exist()
    {
        File::shouldReceive('exists')
            ->once()
            ->with('resources/blogs/published/does-not-exist.md')
            ->andReturn(false);

        $this->get('/blog/does-not-exist')->assertStatus(404);
    }

    /** @test */
    public function it_converts_md_to_html()
    {
        File::shouldReceive('exists')
            ->once()
            ->with('resources/blogs/published/published-post.md')
            ->andReturn(true);
        File::shouldReceive('get')
            ->once()
            ->with('resources/blogs/published/published-post.md')
            ->andReturn('# Hello World!');

        $this->get('/blog/published-post')
            ->assertOk()
            ->assertSee(value: '<h1>Hello World!</h1>', escape: false);
    }

    // it has named routes
    // it lists published blogs
}
