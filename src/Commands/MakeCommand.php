<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeCommand extends Command
{
    public $signature = 'blog:make {title?}';

    public $description = 'create new blog file from string';

    public function handle()
    {
        $title = $this->argument('title') ?? $this->ask('What is the name of your blog post?');
        $title = Str::slug($title);
        $this->comment($title);

        // check for resources/blog/unpublished directory, create if not exists
        // check for .md file with same name as slug, prompt if exists
        // create .md file with slug name, using stub

        $this->comment('All done. Now get writing ;)');
    }
}
