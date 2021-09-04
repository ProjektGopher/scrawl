<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    public $signature = 'blog:publish {title?}';

    public $description = 'move .md file from unpublished to published directory';

    public $publishedDirectory = 'resources/blogs/published';
    public $unpublishedDirectory = 'resources/blogs/unpublished';

    public function handle(): void
    {
        $title = $this->argument('title')
            ?? $this->ask('What is the name of your blog post?');
        $title = Str::slug($title);
        $this->comment($title);

        File::ensureDirectoryExists($this->publishedDirectory);

        if (!File::exists("{$this->unpublishedDirectory}/{$title}.md")) {
            $this->warn("We couldn't find this file. Try again with a different name.");
            return;
        }

        if (File::exists("{$this->publishedDirectory}/{$title}.md")) {
            $this->warn('This file already exists. Try again with a different name.');
            return;
        }

        // try/catch moving markdown file
        File::move(
            "{$this->unpublishedDirectory}/{$title}.md",
            "{$this->publishedDirectory}/{$title}.md"
        );
        $this->comment("All done. Don't forget to commit, push, and deploy ;)");
    }
}
