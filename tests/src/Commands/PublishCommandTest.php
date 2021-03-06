<?php

namespace Projektgopher\Scrawl\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Projektgopher\Scrawl\Blog;

class PublishCommandTest extends TestCase
{
    /** @test */
    public function it_has_a_publish_command()
    {
        File::spy();
        $this->assertTrue(Arr::has(Artisan::all(), 'blog:publish'));
    }

    /** @test */
    public function it_accepts_a_title_argument()
    {
        File::spy();
        $title = 'Long blog title that has to be sluggified';

        $this->artisan("blog:publish '{$title}'")
            ->expectsOutput(Str::slug($title));
    }

    /** @test */
    public function it_creates_the_published_directory_if_none_exists()
    {
        File::spy();

        $this->artisan('blog:publish blargh');

        File::shouldHaveReceived('ensureDirectoryExists')
            ->with(Blog::published_path())
            ->once();
    }

    /** @test */
    public function it_checks_for_existing_published_markdown_file()
    {
        $name = "Long title that should be sluggified";
        $slug = Str::slug($name);

        File::shouldReceive('ensureDirectoryExists');
        File::shouldReceive('missing')
            ->once()
            ->with(Blog::unpublished_path("{$slug}.md"))
            ->andReturn(false);
        File::shouldReceive('exists')
            ->with(Blog::published_path("{$slug}.md"))
            ->once()
            ->andReturn(true);

        $this->artisan("blog:publish '{$name}'")
            ->expectsOutput('This file already exists. Try again with a different name.');
    }

    /** @test */
    public function it_moves_markdown_file_from_unpublished_to_published()
    {
        $name = "Long title that should be sluggified";
        $slug = Str::slug($name);

        File::shouldReceive('ensureDirectoryExists');
        File::shouldReceive('missing')
            ->once()
            ->with(Blog::unpublished_path("{$slug}.md"))
            ->andReturn(false);
        File::shouldReceive('exists')
            ->once()
            ->with(Blog::published_path("{$slug}.md"))
            ->andReturn(false);
        File::shouldReceive('move')
            ->once()
            ->with(
                Blog::unpublished_path("{$slug}.md"),
                Blog::published_path("{$slug}.md")
            );

        $this->artisan("blog:publish '{$name}'")
            ->expectsOutput("All done. Don't forget to commit, push, and deploy ;)");
    }
}
