<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    public $signature = 'blog:publish {title?}';

    public $description = 'move .md file from unpublished to published directory';

    public $directory = 'resources/blogs/published';

    public function handle(): void
    {
        $title = $this->argument('title')
            ?? $this->ask('What is the name of your blog post?');
        $title = Str::slug($title);
        $this->comment($title);

        File::ensureDirectoryExists($this->directory);

        if (File::exists("{$this->directory}/{$title}.md")) {
            $this->warn('This file already exists. Try a different name.');
            $title = $this->ask('What is the name of your blog post?');
            $title = Str::slug($title);
            // extract this into a function that can call itself again.
        }

        // try/catch creating file from stub
        $this->comment('All done. Don\'t forget to commit, push, and deploy ;)');
    }
}
