<?php

namespace Projektgopher\Scrawl\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Projektgopher\Scrawl\Blog;

class UnpublishCommandTest extends TestCase
{
    /** @test */
    public function it_has_an_unpublish_command()
    {
        File::spy();
        $this->assertTrue(Arr::has(Artisan::all(), 'blog:unpublish'));
    }

    /** @test */
    public function it_accepts_a_title_argument()
    {
        File::spy();
        $title = 'Long blog title that has to be sluggified';

        $this->artisan("blog:unpublish '{$title}'")
            ->expectsOutput(Str::slug($title));
    }

    /** @test */
    public function it_creates_the_unpublished_directory_if_none_exists()
    {
        File::spy();

        $this->artisan('blog:unpublish blargh');

        File::shouldHaveReceived('ensureDirectoryExists')
            ->with(Blog::unpublished_path())
            ->once();
    }

    /** @test */
    public function it_checks_for_existing_unpublished_markdown_file()
    {
        $name = "Long title that should be sluggified";
        $slug = Str::slug($name);

        File::shouldReceive('ensureDirectoryExists');
        File::shouldReceive('missing')
            ->once()
            ->with(Blog::published_path("{$slug}.md"))
            ->andReturn(false);
        File::shouldReceive('exists')
            ->with(Blog::unpublished_path("{$slug}.md"))
            ->once()
            ->andReturn(true);

        $this->artisan("blog:unpublish '{$name}'")
            ->expectsOutput('This file already exists. Try again with a different name.');
    }

    /** @test */
    public function it_moves_markdown_file_from_published_to_unpublished()
    {
        $name = "Long title that should be sluggified";
        $slug = Str::slug($name);

        File::shouldReceive('ensureDirectoryExists');
        File::shouldReceive('missing')
            ->once()
            ->with(Blog::published_path("{$slug}.md"))
            ->andReturn(false);
        File::shouldReceive('exists')
            ->once()
            ->with(Blog::unpublished_path("{$slug}.md"))
            ->andReturn(false);
        File::shouldReceive('move')
            ->once()
            ->with(
                Blog::published_path("{$slug}.md"),
                Blog::unpublished_path("{$slug}.md")
            );

        $this->artisan("blog:unpublish '{$name}'")
            ->expectsOutput("All done. Now you can fix whatever mistake was made ;)");
    }
}
