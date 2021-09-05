<?php

namespace Projektgopher\Scrawl\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Projektgopher\Scrawl\Blog;

class MakeCommand extends Command
{
    public $signature = 'blog:make {title?}';

    public $description = 'create new blog file from string';

    public function handle(): void
    {
        $slug = Str::slug(
            $this->argument('title') ?? $this->ask('What is the name of your blog post?')
        );

        $this->comment($slug);

        File::ensureDirectoryExists(Blog::$unpublishedDirectory);

        if (File::exists(Blog::$unpublishedDirectory . "/{$slug}.md")) {
            $this->warn('This file already exists. Try again with a different name.');

            return;
        }

        $stub = File::get('stubs/blog.md.stub');

        // try/catch creating file from stub
        File::put(Blog::$unpublishedDirectory . "/{$slug}.md", $stub);

        $this->comment('All done. Now get writing ;)');
    }
}
