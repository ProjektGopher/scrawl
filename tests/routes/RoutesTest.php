<?php

namespace Projektgopher\Blog\Tests;

use Illuminate\Support\Facades\File;

class RoutesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_has_a_blog_post_route()
    {
        $this->markTestIncomplete();
        $this->assertTrue(true);
    }

    /** @test */
    public function it_returns_a_200_if_the_blog_exists()
    {
        File::shouldReceive('exists')->with('resources/blogs/published/test.md')->once()->andReturn(true);
        $this->get('/blog/test')->assertOk();
    }

    /** @test */
    public function it_returns_a_404_if_the_blog_does_not_exist()
    {
        File::shouldReceive('exists')->with('resources/blogs/published/does-not-exist.md')->once()->andReturn(false);
        $this->get('/blog/does-not-exist')->assertStatus(404);
    }

    // it has named routes
    // it lists published blogs
}
