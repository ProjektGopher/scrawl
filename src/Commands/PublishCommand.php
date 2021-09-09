<?php

namespace Projektgopher\Scrawl\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Projektgopher\Scrawl\Blog;
use Projektgopher\Scrawl\Exceptions\BlogNotFoundException;
use Projektgopher\Scrawl\Exceptions\BlogAlreadyExistsException;

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

        try {
            Blog::publish($slug);
        }

        catch(BlogNotFoundException $e) {
            $this->warn(
                "We couldn't find this file. Try again with a different name."
            );

            return;
        }

        catch(BlogAlreadyExistsException $e) {
            $this->warn(
                'This file already exists. Try again with a different name.'
            );

            return;
        }

        $this->comment("All done. Don't forget to commit, push, and deploy ;)");
    }
}
