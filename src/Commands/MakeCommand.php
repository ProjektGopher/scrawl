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

        $this->comment("Sluggified title: {$slug}");

        if (! Blog::createFromStubIfNotExists($slug)) {
            $this->warn('This file already exists. Try again with a different name.');

            return;
        }

        $this->comment('All done. Now get writing ;)');
    }
}
