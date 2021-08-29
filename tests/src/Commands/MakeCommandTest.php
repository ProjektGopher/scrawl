<?php

namespace Projektgopher\Blog\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class MakeCommandTest extends TestCase
{
    public $files = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->files['ensureDirectoryExists'] = File::shouldReceive('ensureDirectoryExists');
        $this->files['exists'] = File::shouldReceive('exists');
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
    public function it_creates_the_unpublished_directory_if_none_exists()
    {
        $this->files['ensureDirectoryExists']
            ->with('resources/blogs/unpublished')
            ->once();

        $this->artisan('blog:make test');
    }

    /** @test */
    public function it_checks_for_existing_unpublished_markdown_file()
    {
        $name = "Long title that should be sluggified";
        $slug = Str::slug($name);

        $this->files['exists']
            ->with("resources/blogs/unpublished/{$slug}.md")
            ->once()
            ->andReturn(true);

        $this->artisan("blog:make '{$name}'")
            ->expectsOutput('This file already exists. Try a different name.')
            ->expectsQuestion('What is the name of your blog post?', $name);
    }

    // check for .md file with same name as slug, prompt if exists (published also, could be problem later)
    // create .md file with slug name, using stub
}
