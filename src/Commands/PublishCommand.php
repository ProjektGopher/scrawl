<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Projektgopher\Blog\Blog;

class PublishCommand extends Command
{
    public $signature = 'blog:publish {title?}';

    public $description = 'move .md file from unpublished to published directory';

    public function handle(): void
    {
        $slug = Str::slug(
            $this->argument('title')
                ?? $this->ask('What is the name of your blog post?')
        );

        $this->comment($slug);

        File::ensureDirectoryExists(Blog::$publishedDirectory);

        if (File::missing(Blog::$unpublishedDirectory . "/{$slug}.md")) {
            $this->warn(
                "We couldn't find this file. Try again with a different name."
            );

            return;
        }

        if (File::exists(Blog::$publishedDirectory . "/{$slug}.md")) {
            $this->warn(
                'This file already exists. Try again with a different name.'
            );

            return;
        }

        File::move(
            Blog::$unpublishedDirectory . "/{$slug}.md",
            Blog::$publishedDirectory . "/{$slug}.md"
        );

        $this->comment("All done. Don't forget to commit, push, and deploy ;)");
    }
}
