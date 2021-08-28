<?php

namespace Projektgopher\Blog\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCommandTest extends TestCase
{
    public $files;

    public function setUp(): void
    {
        parent::setUp();
        $this->files = File::shouldReceive('ensureDirectoryExists');
    }

    /** @test */
    public function it_has_a_make_command()
    {
        $this->assertTrue(Arr::has(Artisan::all(), 'blog:make'));
    }

    /** @test */
    public function it_sluggifies_a_title()
    {
        $title = 'Long blog title that has to be sluggified';

        $this->artisan('blog:make')
            ->expectsQuestion('What is the name of your blog post?', $title)
            ->expectsOutput(Str::slug($title));
    }

    /** @test */
    public function it_accepts_a_title_argument()
    {
        $title = 'Long blog title that has to be sluggified';

        $this->artisan("blog:make '{$title}'")
            ->expectsOutput(Str::slug($title));
    }

    /** @test */
    public function it_creates_the_unpublished_blog_directory_if_none_exists()
    {
        $this->files
            ->with('resources/blogs/unpublished')
            ->once();

        $this->artisan('blog:make test');
    }

    // check for .md file with same name as slug, prompt if exists
    // create .md file with slug name, using stub
}
