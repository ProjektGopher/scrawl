<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCommand extends Command
{
    public $signature = 'blog:make {title?}';

    public $description = 'create new blog file from string';

    public $directory = 'resources/blogs/unpublished';

    public function handle(): void
    {
        $title = $this->argument('title') ?? $this->ask('What is the name of your blog post?');
        $title = Str::slug($title);
        $this->comment($title);

        File::ensureDirectoryExists($this->directory);

        $this->comment('All done. Now get writing ;)');
    }
}
