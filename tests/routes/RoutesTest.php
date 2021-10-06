<?php

namespace Projektgopher\Scrawl\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Projektgopher\Scrawl\Blog;

use function Symfony\Component\String\b;

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
        // Arrange
        File::ensureDirectoryExists(
            resource_path(config('scrawl.published_directory'))
        );
        File::put(
            resource_path(config('scrawl.published_directory') . "/published-post.md"),
            "# Hello World!"
        );

        // Act and Assert
        $this->get('/blog/published-post')->assertOk();

        // Cleanup
        File::deleteDirectory(
            resource_path(config('scrawl.blog_directory'))
        );
    }

    /** @test */
    public function it_returns_a_404_if_the_blog_does_not_exist()
    {
        // File::shouldReceive('exists')
        //     ->once()
        //     ->with(base_path('resources/blogs/published/does-not-exist.md'))
        //     ->andReturn(false);

        $this->get('/blog/does-not-exist')->assertStatus(404);
    }

    /** @test */
    public function it_converts_md_to_html()
    {
        // Arrange
        File::ensureDirectoryExists(
            resource_path(config('scrawl.published_directory'))
        );
        File::put(
            resource_path(config('scrawl.published_directory') . "/published-post.md"),
            "# Hello World!"
        );

        // Act and Assert
        $this->get('/blog/published-post')
            ->assertOk()
            ->assertSee(value: '<h1>Hello World!</h1>', escape: false);

        // Cleanup
        File::deleteDirectory(
            resource_path(config('scrawl.blog'))
        );
    }

    // it has named routes
    // it lists published blogs
}
