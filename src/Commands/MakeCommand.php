<?php

namespace Projektgopher\Scrawl\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Projektgopher\Scrawl\Blog;
use Projektgopher\Scrawl\Exceptions\BlogAlreadyExistsException;

class MakeCommand extends Command
{
    public $signature = 'blog:make {title?}';

    public $description = 'create new blog file from string';

    public function __construct()
    {
        parent::__construct();
        $this->setAliases(['make:blog']);
    }

    public function handle(): void
    {
        $slug = Str::slug(
            $this->argument('title')
                ?? $this->ask('What is the name of your blog post?')
        );

        $this->comment("Sluggified title: {$slug}");

        try {
            Blog::make($slug);
        } catch (BlogAlreadyExistsException $e) {
            $this->warn('This file already exists. Try again with a different name.');

            return;
        }

        $this->comment('All done. Now get writing ;)');
    }
}
