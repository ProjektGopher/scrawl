<?php

namespace Projektgopher\Scrawl\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Projektgopher\Scrawl\Blog;
use Projektgopher\Scrawl\Exceptions\BlogNotFoundException;
use Projektgopher\Scrawl\Exceptions\BlogAlreadyExistsException;

class UnpublishCommand extends Command
{
    public $signature = 'blog:unpublish {title?}';

    public $description = 'move .md file from published to unpublished directory';

    public function handle(): void
    {
        $slug = Str::slug(
            $this->argument('title')
                ?? $this->ask('What is the name of your blog post?')
        );

        $this->comment($slug);

        try {
            Blog::unpublish($slug);
        } catch (BlogNotFoundException $e) {
            $this->warn(
                "We couldn't find this file. Try again with a different name."
            );

            return;
        } catch (BlogAlreadyExistsException $e) {
            $this->warn(
                'This file already exists. Try again with a different name.'
            );

            return;
        }

        $this->comment("All done. Now you can fix whatever mistake was made ;)");
    }
}
