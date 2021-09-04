<?php

namespace Projektgopher\Blog\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublishCommandTest extends TestCase
{
    public $files = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->files['ensureDirectoryExists'] = File::shouldReceive('ensureDirectoryExists');
        $this->files['exists'] = File::shouldReceive('exists');
    }

    /** @test */
    public function it_has_a_publish_command()
    {
        $this->assertTrue(Arr::has(Artisan::all(), 'blog:publish'));
    }

    /** @test */
    public function it_accepts_a_title_argument()
    {
        $title = 'Long blog title that has to be sluggified';

        $this->artisan("blog:publish '{$title}'")
            ->expectsOutput(Str::slug($title));
    }

    /** @test */
    public function it_creates_the_published_directory_if_none_exists()
    {
        $this->files['ensureDirectoryExists']
            ->with('resources/blogs/published')
            ->once();

        $this->artisan('blog:publish blargh');
    }

    /** @test */
    public function it_checks_for_existing_published_markdown_file()
    {
        $name = "Long title that should be sluggified";
        $slug = Str::slug($name);

        $this->files['exists']
            ->with("resources/blogs/published/{$slug}.md")
            ->once()
            ->andReturn(true);

        $this->artisan("blog:publish '{$name}'")
            ->expectsOutput('This file already exists. Try a different name.')
            ->expectsQuestion('What is the name of your blog post?', $name);
    }

    // check for .md file with same name as slug, prompt if exists (published also, could be problem later)
    // create .md file with slug name, using stub
}
