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
        $title = $this->argument('title')
            ?? $this->ask('What is the name of your blog post?');
        $title = Str::slug($title);
        $this->comment($title);

        File::ensureDirectoryExists(Blog::$publishedDirectory);

        if (! File::exists(Blog::$unpublishedDirectory . "/{$title}.md")) {
            $this->warn(
                "We couldn't find this file. Try again with a different name."
            );

            return;
        }

        if (File::exists(Blog::$publishedDirectory . "/{$title}.md")) {
            $this->warn(
                'This file already exists. Try again with a different name.'
            );

            return;
        }

        // try/catch moving markdown file
        File::move(
            Blog::$unpublishedDirectory . "/{$title}.md",
            Blog::$publishedDirectory . "/{$title}.md"
        );
        $this->comment("All done. Don't forget to commit, push, and deploy ;)");
    }
}
